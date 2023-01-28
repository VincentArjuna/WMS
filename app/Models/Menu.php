<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subMenu()
    {
        return $this->hasMany(Menu::class, 'main_menu');
    }

    public function mainMenu()
    {
        return $this->belongsTo(Menu::class, 'main_menu');
    }
}
