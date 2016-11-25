<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tracker extends Model
{
    protected $table = 'tracker';

    public function actionItems()
    {
        return $this->hasMany(ActionItems::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
