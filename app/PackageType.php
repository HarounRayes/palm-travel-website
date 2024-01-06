<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageType extends Model
{
    protected $fillable = ['package_id', 'type_id'];

    public function type()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }
}
