<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $table = 'tracker';

    public function actionItems()
    {
        return $this->hasMany(ActionItems::class);
    }
}
