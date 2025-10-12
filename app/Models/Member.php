<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'membership_date',
        'status'
    ];
    
    protected $casts = [
        'membership_date' => 'date',
    ];
    
    public function borrowings():HasMany
    {
        return $this->hasMany(Borrowing::class);
    }
    
    //helper method to get active borrowings
    public function activeBorrowings():HasMany
    {
        return $this->borrowings()->where('status', 'borrowed');
    }
}