<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyMarkModel extends Model
{
    use HasFactory;
    protected $table ="dummy_mark";
    protected $primaryKey ="dummy_mark_id";
}