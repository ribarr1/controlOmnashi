<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Paquete extends Model
{
    
  protected $fillable = ['nombre', 'precio'];
  protected $guarded = ['id'];
}
