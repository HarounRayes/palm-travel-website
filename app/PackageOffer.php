<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageOffer extends Model
{
    protected $fillable = ['package_id', 'offer_id'];

    public function offer()
    {
        return $this->hasOne(Offer::class, 'id', 'offer_id');
    }
}
