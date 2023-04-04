<?php
  
namespace App\Enums;

enum EventCategoryEnum:string {
    case product_launch = 'product_launch';
    case product_review = 'product_review';
}