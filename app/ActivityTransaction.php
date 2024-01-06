<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class ActivityTransaction extends Model
{
    protected $fillable = ['activity_order_id', 'member_id','transaction_id', 'amount', 'currency', 'payment_status', 'payment_intent'];

    public function order()
    {
        return $this->hasOne(VisaUaeApplication::class, 'id', 'activity_order_id');
    }
}
