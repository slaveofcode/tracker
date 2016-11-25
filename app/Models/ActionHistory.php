<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    protected $table        = 'action_history';
    public $timestamps      = false;
    protected $casts        = [
        'start_time' => 'datetime',
        'finish_time' => 'datetime',
    ];

    const STATUS_STARTED    = 'STARTED';
    const STATUS_FINISHED   = 'FINISHED';

    public function actionItem()
    {
        return $this->belongsTo(ActionItem::class);
    }

    public function isFinished()
    {
        return !is_null($this->finish_time);
    }
}
