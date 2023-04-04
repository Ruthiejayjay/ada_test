<?php
  
namespace App\Enums;

enum UserAccountTypeEnum:string {
    case Individual = 'Individual';
    case Organization = 'Organization';
}