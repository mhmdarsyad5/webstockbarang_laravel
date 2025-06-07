<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    protected $table = 'staff';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_staff',
        'jabatan',
        'divisi',
        'notelp_staff'
    ];

    /**
     * Get all pengajuan for the staff
     */
    public function pengajuan(): HasMany
    {
        return $this->hasMany(Pengajuan::class, 'id_staff', 'id');
    }

    /**
     * Get all barang masuk for the staff
     */
    public function barangMasuk(): HasMany
    {
        return $this->hasMany(BarangMasuk::class, 'id_staff', 'id');
    }

    /**
     * Get all barang keluar for the staff
     */
    public function barangKeluar(): HasMany
    {
        return $this->hasMany(BarangKeluar::class, 'id_staff', 'id');
    }
}
