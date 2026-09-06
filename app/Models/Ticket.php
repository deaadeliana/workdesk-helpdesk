<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_number',
        'user_id',
        'ticket_category_id',
        'technician_id',
        'title',
        'description',
        'priority',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            TicketCategory::class,
            'ticket_category_id'
        );
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'technician_id'
        );
    }
}