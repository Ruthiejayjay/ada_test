<?php

namespace App\Models;

use App\Enums\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTransactions extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'no_of_purchase', 'fee', 'status', 'amount', 'ticket_id'
    ];

    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }

    protected $casts = [
        'status' =>TransactionStatusEnum::class
    ];
}
