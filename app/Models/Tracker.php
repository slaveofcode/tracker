<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tracker extends Model
{
    protected $table = 'tracker';

    public function actionItems()
    {
        return $this->hasMany(ActionItem::class);
    }

    public function actionHistories()
    {
        return $this->hasManyThrough(ActionHistory::class, ActionItem::class, 'tracker_id', 'action_item_id')->orderBy('start_time');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
