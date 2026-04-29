<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'nomor_handphone',
        'program_studi',
        'lokasi_kerusakan',
        'deskripsi_kerusakan',
        'foto_kerusakan',
        'ditujukan_kepada',
        'status',
        'rejection_reason',
    ];
    
// Report.php
public function reviews()
{
    return $this->hasMany(Review::class);
}
        

}