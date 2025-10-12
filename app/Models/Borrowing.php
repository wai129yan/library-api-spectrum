<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowingFactory> */
    use HasFactory;
    protected $fillable = [
        'book_id',
        'member_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function member():BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function isOverdue():bool
    {
        return $this->due_date < Carbon::today() && $this->status === 'borrowed';
    }
}