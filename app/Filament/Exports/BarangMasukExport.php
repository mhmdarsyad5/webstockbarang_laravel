<?php

namespace App\Filament\Exports;

use App\Models\BarangMasuk;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;

class BarangMasukExport extends ExcelExport
{
    public function setUp()
    {
        $this->withFilename('laporan-barang-masuk-' . now()->format('d-m-Y-H-i'))
            ->withColumns([
                Column::make('bm_kode')
                    ->heading('Kode'),
                Column::make('barang.nama_barang')
                    ->heading('Nama Barang'),
                Column::make('staff.nama_staff')
                    ->heading('Staff'),
                Column::make('bk_tanggal')
                    ->heading('Tanggal'),
                Column::make('bk_jumlah')
                    ->heading('Jumlah'),
                Column::make('created_at')
                    ->heading('Tanggal Dibuat')
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i')),
            ]);
    }
} 