<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;
    protected $table = 'jamaah';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'phone',
        'passpor',
        'dp',
        'tgl_berangkat',
        'user_id',
        'cabang_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }
}
