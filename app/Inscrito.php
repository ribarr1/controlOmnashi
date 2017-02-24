<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscrito extends Model
{
    protected $table = "inscritos";
    
    protected $fillable = ['fecha','documento','nombre','correo','telefono'];
    
    public function inscritos_asistencias()
    {
        return $this->hasMany('app\Inscrito_asistencia');
    }
    public function tipodocumento()
    {
        return $this->belongsTo('app\Tipodocumento');
    }
   
     public function paquetes_inscritos()
    {
        return $this->hasMany('app\Paquete_inscrito');
    }
}
