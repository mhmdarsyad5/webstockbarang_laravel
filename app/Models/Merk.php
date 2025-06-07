<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merk extends Model
{
    protected $table = 'merks';

    protected $fillable = [
        'merk_nama',
        'merk_keterangan'
    ];

    /**
     * Get all data barang for the merk
     */
    public function dataBarang(): HasMany
    {
        return $this->hasMany(DataBarang::class, 'id_merk', 'id');
    }
}
