<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataBarang extends Model
{
    protected $table = 'data_barangs';
    
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'barang_kode',
        'jenisbarang_id',
        'id_merk',
        'stock_barang',
        'harga_barang',
        'gambar_barang'
    ];

    /**
     * Get the jenis barang that owns the data barang
     */
    public function jenisBarang(): BelongsTo
    {
        return $this->belongsTo(JenisBarang::class, 'jenisbarang_id', 'id');
    }

    /**
     * Get the merk that owns the data barang
     */
    public function merk(): BelongsTo
    {
        return $this->belongsTo(Merk::class, 'id_merk', 'id');
    }

    /**
     * Get the barang masuk for the data barang
     */
    public function barangMasuk(): HasMany
    {
        return $this->hasMany(BarangMasuk::class, 'id_barang', 'id_barang');
    }
}
