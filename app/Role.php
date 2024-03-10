<?php

namespace App;

use App\Scopes\SuperadminRoleScope;


class Role extends \Spatie\Permission\Models\Role
{
    protected static function booted()
    {
        static::addGlobalScope(new SuperadminRoleScope());
    }
    public function rolePermissions(){
        return $this->hasMany(RoleHasPermissions::class,'role_id','id');
    }
}
