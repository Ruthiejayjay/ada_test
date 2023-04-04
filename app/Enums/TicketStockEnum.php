<?php
  
namespace App\Enums;

enum TicketStockEnum:string {
    case unlimited = 'unlimited';
    case limited = 'limited';
}