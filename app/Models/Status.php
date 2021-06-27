<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    // *********************** START PARENT CLASS ****************************

    // *********************** END PARENT CLASS *******************************

    // *********************** START CHILD CLASS ***************************

    /**
     * Get the leads that have the status.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get the orders that have the status.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // *********************** END CHILD CLASS ******************************

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'description',];
}
