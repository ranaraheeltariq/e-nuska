<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

    // *********************** START PARENT CLASS ***************************

    // *********************** END PARENT CLASS ******************************

    // *********************** START CHILD CLASS ***************************

    /**
     * Get the leads for the doctor.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    /**
     * Get the leads for the doctor.
     */
    public function orders()
    {
        return $this->hasMany(Lead::class);
    }

    // *********************** END CHILD CLASS ******************************

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['doctor_name', 'doctor_number', 'doctor_clinic',];
}
