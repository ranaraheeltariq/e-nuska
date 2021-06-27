<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    
    // *********************** START PARENT CLASS ****************************

    /**
     * Get the lead that belong to the product.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    // *********************** END PARENT CLASS *******************************

    // *********************** START CHILD CLASS ***************************

    // *********************** END CHILD CLASS *****************************

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['medicine_name', 'quantity', 'lead_id',];
}
