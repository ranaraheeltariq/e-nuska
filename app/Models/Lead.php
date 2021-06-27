<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
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

    // *********************** END PARENT CLASS *******************************

    // *********************** START CHILD CLASS ***************************

    /**
     * Get the product of the lead.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the leads for the doctor.
     */
    public function orders()
    {
        return $this->hasOne(Lead::class);
    }

    /**
     * Get the leads for the doctor.
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
    protected $fillable = ['customer_name', 'customer_number', 'file1', 'file2', 'doctor_id', 'status_id'];
}
