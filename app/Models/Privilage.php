<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilage extends Model
{
    use HasFactory;
    protected $table = 'privilages';
    protected $fillable = ['role_id', 'sidebar_id'];

    public function sidebar()
    {
        return $this->belongsTo(Sidebar::class, 'sidebar_id');
    }
}
