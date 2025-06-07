<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisBarang extends Model
{
    protected $table = 'jenis_barangs';

    protected $fillable = [
        'jenisbarang_ket'
    ];

    /**
     * Get all data barang for the jenis barang
     */
    public function dataBarang(): HasMany
    {
        return $this->hasMany(DataBarang::class, 'jenisbarang_id', 'id');
    }
}
