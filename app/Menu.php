<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function submenu()
    {
        return $this->hasMany(SubMenu::class);
    }
    protected $table = "menus";
    protected $fillable = ['menu_name', 'url', 'status'];
}
