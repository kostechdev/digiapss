<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Exports\PendudukExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Penduduk;
use Maatwebsite\Excel\Excel as ExcelWriterType;

class PendudukExportController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $payload = $request->query('p');
        try {
            $data = $payload ? json_decode(Crypt::decryptString($payload), true) : [];
        } catch (\Throwable $e) {
            abort(400);
        }
        if (! is_array($data)) {
            abort(422);
        }
        $allowed = ['no','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','pekerjaan','alamat','no_hp','status_perkawinan','rw','rt','created_at'];
        $columns = array_values(array_intersect($allowed, (array)($data['columns'] ?? [])));
        if (empty($columns)) {
            $columns = ['no','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','pekerjaan','alamat','no_hp','status_perkawinan','rw','rt','created_at'];
        }
        $filters = [
            'mode' => in_array(($data['mode'] ?? 'all'), ['all','rw','rt','custom']) ? $data['mode'] : 'all',
            'rw_id' => $data['rw_id'] ?? null,
            'rt_id' => $data['rt_id'] ?? null,
            'ids' => is_array($data['ids'] ?? null) ? $data['ids'] : [],
        ];
        $filenameBase = 'data-penduduk-' . date('Y-m-d-His');
        try {
            @ini_set('memory_limit', '512M');
            @set_time_limit(120);
            $countQuery = Penduduk::query();
            if ($filters['mode'] === 'rw' && $filters['rw_id']) {
                $countQuery->where('rw_id', $filters['rw_id']);
            } elseif ($filters['mode'] === 'rt' && $filters['rt_id']) {
                $countQuery->where('rt_id', $filters['rt_id']);
            } elseif ($filters['mode'] === 'custom' && !empty($filters['ids'])) {
                $countQuery->whereIn('id', $filters['ids']);
            }
            $totalRows = (int) $countQuery->count('id');
            $hasNik = in_array('nik', $columns, true);
            $useCsv = $totalRows > 5000 && ! $hasNik;
            $writerType = $useCsv ? ExcelWriterType::CSV : ExcelWriterType::XLSX;
            $extension = $useCsv ? 'csv' : 'xlsx';
            $filename = $filenameBase . '.' . $extension;
            if ($useCsv) {
                $filters['date_as_text'] = true;
            }
            return Excel::download(new PendudukExport($columns, $filters), $filename, $writerType);
        } catch (\Throwable $e) {
            Log::error('Export penduduk gagal', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response($e->getMessage(), 500);
        }
    }
}
