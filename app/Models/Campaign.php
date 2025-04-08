<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['user_id', 'subject', 'status', 'sent_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(Subscriber::class,'campaign_subscriber');
    }
}
