<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\BaseModel;

class Activity extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
