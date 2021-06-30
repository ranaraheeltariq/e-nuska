<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    // *********************** START PARENT CLASS ****************************

    /**
     * Get the doctor that belong to lead.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the status that assign to lead.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the user that assign to order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the lead of the order.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    // *********************** END PARENT CLASS *******************************

    // *********************** START CHILD CLASS ***************************

    /**
     * Get the order product of the order.
     */
    public function orderproducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * Get the order product of the order.
     */
    public function smslogs()
    {
        return $this->hasMany(SmsLog::class);
    }

    // *********************** END CHILD CLASS *****************************

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_name', 'customer_number', 'customer_address', 'lead_id', 'doctor_id', 'user_id', 'status_id', 'invoice_with_discount', 'invoice_without_discount', 'invoice_file','approved',];
}
