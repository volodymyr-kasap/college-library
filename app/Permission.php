<?php namespace App;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $table = 'permissions';

    public function roles()
    {
        return $this->belongsToMany('App\Role','permission_role','permission_id','role_id');
    }
}