<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
    protected $table = 'action_item';

    public function tracker()
    {
        return $this->belongsTo(Tracker::class);
    }

    public function actionHistories()
    {
        return $this->hasMany(ActionHistory::class);
    }
}
