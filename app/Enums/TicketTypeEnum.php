<?php
  
namespace App\Enums;

enum TicketTypeEnum:string {
    case free = 'free';
    case paid = 'paid';
    case invite_only = 'invite_only';
}