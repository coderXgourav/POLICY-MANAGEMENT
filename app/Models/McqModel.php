<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqModel extends Model
{
    use HasFactory;
    protected $table = "mcq";
    protected $primaryKey = "mcq_id";

}
