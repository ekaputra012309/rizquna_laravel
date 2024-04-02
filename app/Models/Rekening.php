<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'rekenings';
    protected $primaryKey = 'id_rekening';
    // Define fillable columns
    protected $fillable = [
        'rekening_id',
        'no_rek',
        'keterangan',
        // Add other columns as needed
    ];
}
