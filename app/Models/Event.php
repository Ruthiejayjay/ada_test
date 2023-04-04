<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','description', 'location', 'location_tip', 'event_type', 'virtual_meet_link', 'event_categories', 'custom_url', 'user_id',
        'event_frequency', 'start_date', 'start_time', 'end_time', 'end_date', 'twitter_url', 'facebook_url', 'instagram_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        // this is a relationship towards User model, but we name it differently
        // therefore we must use explicitly state key
        return $this->belongsTo(User::class, 'user_id');
    }
}
