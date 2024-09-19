<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassMarkModel extends Model
{
    use HasFactory;
    protected $table = "pass_mark";
    protected $primaryKey = "pass_mark_id";
}
