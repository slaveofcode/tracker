<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
    protected $table = 'action_item';

    const STATUS_PAUSED     = 'PAUSED';
    const STATUS_RUNNING    = 'RUNNING';
    const STATUS_DONE       = 'DONE';

    public function tracker()
    {
        return $this->belongsTo(Tracker::class);
    }

    public function actionHistories()
    {
        return $this->hasMany(ActionHistory::class);
    }
}
