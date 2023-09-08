<?php

namespace App\Models;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    
    use HasFactory;
    protected $table = "status";
    protected $fillable = ['user_id', 'listing_id', 'applied','applied_on'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'applied_on' => 'datetime',
    ];

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship To Listing
    public function listing() {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    
}
