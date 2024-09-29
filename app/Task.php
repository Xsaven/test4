<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $title
 * @property string $description
 * @property bool $is_completed
 * @property int $user_id
 */
class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'user_id',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'user_id' => 'integer',
    ];
}
