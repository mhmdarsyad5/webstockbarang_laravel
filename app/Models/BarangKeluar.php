<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluars';
    
    protected $fillable = [
        'bk_kode',
        'id_barang',
        'id_staff',
        'bk_tanggal',
        'bk_tujuan',
        'bk_jumlah'
    ];

    /**
     * Get the barang that owns the barang keluar
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(DataBarang::class, 'id_barang', 'id_barang');
    }

    /**
     * Get the staff that owns the barang keluar
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id');
    }
}
