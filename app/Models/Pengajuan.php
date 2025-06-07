<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    protected $table = 'pengajuans';
    
    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        'id_staff',
        'nama_barang',
        'jumlah_barang',
        'tanggal'
    ];

    /**
     * Get the staff that owns the pengajuan
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'id_staff', 'id');
    }
}
