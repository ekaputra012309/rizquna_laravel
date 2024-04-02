<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidebar extends Model
{
    use HasFactory;
    protected $table = 'sidebars';
    protected $fillable = ['label', 'icon', 'url', 'parent_id'];
    public function children()
    {
        return $this->hasMany(Sidebar::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Sidebar::class, 'parent_id');
    }

    public function privilages()
    {
        return $this->belongsTo(Privilage::class, 'sidebar_id');
    }
}
