<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class PendudukExport implements FromQuery, WithHeadings, WithMapping, WithChunkReading, WithColumnFormatting, WithStyles
{
    protected $selectedColumns;
    protected array $filters = [];
    protected array $baseOrder = ['no','nik','nama','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','pekerjaan','alamat','no_hp','status_perkawinan','rw','rt','created_at'];

    public function __construct($selectedColumns = null, array $filters = [])
    {
        $this->selectedColumns = $selectedColumns ?? ['no', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'pekerjaan', 'alamat', 'no_hp', 'status_perkawinan', 'rw', 'rt', 'created_at'];
        $this->filters = $filters;
    }

    public function query()
    {
        $q = Penduduk::query()
            ->leftJoin('rts', 'rts.id', '=', 'penduduk.rt_id')
            ->leftJoin('rws', 'rws.id', '=', 'penduduk.rw_id')
            ->select([
                'penduduk.id',
                'penduduk.nik',
                'penduduk.nama',
                'penduduk.tempat_lahir',
                'penduduk.tanggal_lahir',
                'penduduk.jenis_kelamin',
                'penduduk.agama',
                'penduduk.pekerjaan',
                'penduduk.alamat',
                'penduduk.no_hp',
                'penduduk.status_perkawinan',
                'penduduk.created_at',
                'rws.nomor_rw as rw_nomor',
                'rts.nomor_rt as rt_nomor',
            ])
            ->orderBy('penduduk.tanggal_lahir', 'asc');
        $mode = $this->filters['mode'] ?? 'all';
        if ($mode === 'rw' && !empty($this->filters['rw_id'])) {
            $q->where('penduduk.rw_id', $this->filters['rw_id']);
        } elseif ($mode === 'rt' && !empty($this->filters['rt_id'])) {
            $q->where('penduduk.rt_id', $this->filters['rt_id']);
        } elseif ($mode === 'custom' && !empty($this->filters['ids']) && is_array($this->filters['ids'])) {
            $q->whereIn('penduduk.id', $this->filters['ids']);
        }
        return $q;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function headings(): array
    {
        $allHeadings = [
            'no' => 'No',
            'nik' => 'NIK',
            'nama' => 'Nama Lengkap',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'pekerjaan' => 'Pekerjaan',
            'alamat' => 'Alamat',
            'no_hp' => 'No HP',
            'status_perkawinan' => 'Status Perkawinan',
            'rw' => 'RW',
            'rt' => 'RT',
            'created_at' => 'Tanggal Daftar'
        ];
        $cols = $this->outputColumns();
        $result = [];
        foreach ($cols as $c) {
            $result[] = $allHeadings[$c];
        }
        return $result;
    }

    public function map($penduduk): array
    {
        static $no = 0;
        $no++;

        $allData = [
            'no' => $no,
            'nik' => $penduduk->nik !== null ? ("'" . (string) $penduduk->nik) : '',
            'nama' => $penduduk->nama,
            'tempat_lahir' => $penduduk->tempat_lahir,
            'tanggal_lahir' => $this->excelDateValue($penduduk->tanggal_lahir, false),
            'jenis_kelamin' => $penduduk->jenis_kelamin,
            'agama' => $penduduk->agama,
            'pekerjaan' => $penduduk->pekerjaan,
            'alamat' => $penduduk->alamat,
            'no_hp' => $penduduk->no_hp,
            'status_perkawinan' => $penduduk->status_perkawinan,
            'rw' => isset($penduduk->rw_nomor) ? $penduduk->rw_nomor : '',
            'rt' => isset($penduduk->rt_nomor) ? $penduduk->rt_nomor : '',
            'created_at' => $this->excelDateValue($penduduk->created_at, true)
        ];

        $cols = $this->outputColumns();
        $row = [];
        foreach ($cols as $c) {
            $row[] = $allData[$c];
        }
        return $row;
    }

    public function columnFormats(): array
    {
        $formats = [];
        $letters = $this->letters();
        $ordered = $this->outputColumns();
        foreach ($ordered as $i => $col) {
            $letter = $letters[$i] ?? null;
            if (! $letter) {
                continue;
            }
            if ($col === 'nik') {
                $formats[$letter] = NumberFormat::FORMAT_TEXT;
            }
            if ($col === 'tanggal_lahir') {
                $formats[$letter] = 'dd/mm/yyyy';
            }
            if ($col === 'created_at') {
                $formats[$letter] = 'dd/mm/yyyy hh:mm';
            }
        }
        return $formats;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E5F1FB'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    protected function excelDateValue($value, bool $withTime = false)
    {
        if (empty($value)) {
            return null;
        }
        $dt = is_string($value) ? Carbon::parse($value) : $value;
        if (!empty($this->filters['date_as_text'])) {
            return $withTime ? $dt->format('d/m/Y H:i') : $dt->format('d/m/Y');
        }
        return ExcelDate::dateTimeToExcel($withTime ? $dt : $dt->startOfDay());
    }

    protected function letters(): array
    {
        $letters = [];
        for ($i = 0; $i < 26; $i++) {
            $letters[] = chr(ord('A') + $i);
        }
        for ($i = 0; $i < 26; $i++) {
            $letters[] = 'A' . chr(ord('A') + $i);
        }
        return $letters;
    }

    protected function outputColumns(): array
    {
        $allowed = array_flip($this->selectedColumns);
        $ordered = [];
        foreach ($this->baseOrder as $c) {
            if (isset($allowed[$c])) {
                $ordered[] = $c;
            }
        }
        return $ordered;
    }
}
