<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    // *********************** START PARENT CLASS ***************************

    /**
     * Get the order of the medicine.
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
    protected $fillable = ['medicine_name', 'quantity', 'order_id',];
}
