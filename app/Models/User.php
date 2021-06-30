<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    // *********************** START PARENT CLASS ****************************

     /**
     * Get the department associated with the user.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // *********************** END PARENT CLASS *******************************

    // *********************** START CHILD CLASS ***************************

    /**
     * Get the orders that have the user.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get the orders that have the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the user logs for the user.
     */
    public function userlogs()
    {
        return $this->hasMany(UserLog::class);
    }

    /**
     * Get the remarks for the user.
     */
    public function remarks()
    {
        return $this->hasMany(Remark::class);
    }

    // *********************** END CHILD CLASS *****************************


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'mobile',
        'image',
        'approval_auth',
        'password',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
