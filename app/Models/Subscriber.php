<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['email', 'name', 'newsletter_id', 'status'];

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class, 'campaign_subscriber');
    }
}
