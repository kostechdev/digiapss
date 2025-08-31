<?php

namespace App\Filament\Resources\Penduduks\Pages;

use App\Filament\Resources\Penduduks\PendudukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use App\Exports\PendudukExport;
use Filament\Forms;
use App\Models\Rw;
use App\Models\Rt;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Crypt;

class ListPenduduks extends ListRecords
{
    protected static string $resource = PendudukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('export')
                ->label('Export Excel')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->form([
                    Forms\Components\Radio::make('mode')
                        ->label('Mode Data')
                        ->options([
                            'all' => 'Semua',
                            'rw' => 'Per RW',
                            'rt' => 'Per RT',
                            'custom' => 'Custom Data',
                        ])
                        ->inline()
                        ->default('all')
                        ->live(),
                    Forms\Components\Select::make('rw_id')
                        ->label('Pilih RW')
                        ->options(fn () => Rw::query()->orderBy('nomor_rw')->pluck('nomor_rw', 'id')->toArray())
                        ->searchable()
                        ->required(fn ($get) => in_array($get('mode'), ['rw','rt']))
                        ->visible(fn ($get) => in_array($get('mode'), ['rw','rt']))
                        ->live(),
                    Forms\Components\Select::make('rt_id')
                        ->label('Pilih RT')
                        ->options(fn ($get) => Rt::query()
                            ->when($get('rw_id'), fn ($q, $rw) => $q->where('rw_id', $rw))
                            ->orderBy('nomor_rt')
                            ->pluck('nomor_rt', 'id')
                            ->toArray())
                        ->searchable()
                        ->required(fn ($get) => $get('mode') === 'rt')
                        ->visible(fn ($get) => $get('mode') === 'rt')
                        ->live(),
                    Forms\Components\Select::make('ids')
                        ->label('Pilih Data')
                        ->multiple()
                        ->searchable()
                        ->options(fn () => Penduduk::query()
                            ->orderBy('nama')
                            ->limit(500)
                            ->get()
                            ->mapWithKeys(fn ($p) => [$p->id => $p->nik . ' - ' . $p->nama])
                            ->toArray())
                        ->required(fn ($get) => $get('mode') === 'custom')
                        ->minItems(1)
                        ->visible(fn ($get) => $get('mode') === 'custom'),
                    \Filament\Forms\Components\CheckboxList::make('columns')
                        ->label('Pilih Kolom yang Akan Diekspor')
                        ->options([
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
                        ])
                        ->default(['no', 'nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'agama', 'pekerjaan', 'alamat', 'no_hp', 'status_perkawinan', 'rw', 'rt'])
                        ->columns(2)
                        ->required()
                ])
                ->action(function (array $data) {
                    $filters = [
                        'mode' => $data['mode'] ?? 'all',
                        'rw_id' => $data['rw_id'] ?? null,
                        'rt_id' => $data['rt_id'] ?? null,
                        'ids' => $data['ids'] ?? [],
                    ];
                    $payload = [
                        'columns' => $data['columns'] ?? [],
                        'mode' => $filters['mode'],
                        'rw_id' => $filters['rw_id'],
                        'rt_id' => $filters['rt_id'],
                        'ids' => $filters['ids'],
                    ];
                    $enc = Crypt::encryptString(json_encode($payload));
                    return redirect()->to(route('penduduks.export', ['p' => $enc]));
                }),
        ];
    }

    protected function getEmptyStateActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
