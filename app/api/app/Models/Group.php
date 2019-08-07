<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use SoftDeletes;
    use NodeTrait;

    protected $fillable = [
        'name', 'parent_id'
    ];

    protected $dates = [
        'deleted_at'
    ];
}
