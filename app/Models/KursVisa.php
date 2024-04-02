<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursVisa extends Model
{
    use HasFactory;
    protected $table = 'kurs_visas';
    protected $primaryKey = 'id_kurs';
    protected $fillable = [
        'id_visa',
        'kurs_bsi',
        'kurs_riyal',
        'hasil_konversi',
        'status',
    ];

    public function visa()
    {
        return $this->belongsTo(Visa::class, 'id_visa');
    }
}
