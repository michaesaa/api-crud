<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Hasfactory;;

class Articulo extends Model
{
    use Hasfactory;
    protected $fiollable = ['description','precio', 'stock'];

}
