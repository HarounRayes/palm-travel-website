<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class EnquiryTransaction extends Model
{
    protected $fillable = ['enquiry_id', 'member_id', 'transaction_id', 'amount', 'currency', 'payment_status', 'payment_intent'];

    public function enquiry()
    {
        return $this->hasOne(Enquiry::class, 'id', 'enquiry_id');
    }
}
