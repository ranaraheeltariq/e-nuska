<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    // *********************** START PARENT CLASS ***************************

    /**
     * Get the user that assign to order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // *********************** END PARENT CLASS ******************************

    // *********************** START CHILD CLASS ***************************

    // *********************** END CHILD CLASS *****************************

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'description',];
}
