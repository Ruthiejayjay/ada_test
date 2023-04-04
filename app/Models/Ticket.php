<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'ticket_type', 'ticket_stock', 'no_of_stock', 'purchase_limit', 'price', 'event_id'
    ];

    public function events()
    {
        return $this->belongsTo(Event::class);
    }
}
