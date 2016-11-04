<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    protected $table    = 'action_history';
    public $timestamps  = false;

    public function actionItem()
    {
        return $this->belongsTo(ActionItem::class);
    }
}
