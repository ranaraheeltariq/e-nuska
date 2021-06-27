<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    // *********************** START PARENT CLASS ***************************

    /**
     * Get the lead that belong to the remarks.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // *********************** END PARENT CLASS ******************************

    // *********************** START CHILD CLASS ***************************

    // *********************** END CHILD CLASS *****************************

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mobile', 'sms', 'status', 'order_id',];
}
