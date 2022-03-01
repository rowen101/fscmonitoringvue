<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    protected $table = "sub_menus";
    protected $fillable = ['submenu_name', 'link', 'menu_id'];
}
