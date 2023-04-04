<?php
  
namespace App\Enums;

enum EventFrequencyEnum:string {
    case single = 'single';
    case recurring = 'recurring';
}