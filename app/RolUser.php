<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolUser extends Model
{
    //
    protected $table = 'role_user';

    protected $fillable = ['id','role_id','user_id'];

    public function buscarRolUser($user_id) 
    {

        $rolIdUser = $this->where('user_id','=',$user_id)->value('role_id');

        return $rolIdUser;

    }
}
