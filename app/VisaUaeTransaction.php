<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class VisaUaeTransaction extends Model
{
    protected $fillable = ['application_id', 'member_id', 'transaction_id', 'amount', 'currency', 'payment_status', 'payment_intent'];

    public function application()
    {
        return $this->hasOne(VisaUaeApplication::class, 'id', 'application_id');
    }
}
