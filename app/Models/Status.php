<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 * @method static paginate()
 * @method static latest()
 */
class Status extends Model
{
    use HasFactory;

    protected $guarded = [];
}
