<?php
  
namespace App\Enums;

enum TransactionStatusEnum:string {
    case pending = 'pending';
    case successful = 'successful';
    case failed = 'failed';
}