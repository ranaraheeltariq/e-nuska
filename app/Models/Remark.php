<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    use HasFactory;

    // *********************** START PARENT CLASS ***************************

    /**
     * Get the lead that belong to the remarks.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    /**
     * Get the user that give the remarks.
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
    protected $fillable = ['lead_id', 'description', 'user_id',];
}
