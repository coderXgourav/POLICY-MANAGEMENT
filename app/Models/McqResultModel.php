<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqResultModel extends Model
{
    use HasFactory;
    protected $table = "mcq_result";
    protected $primaryKey = "mcq_result_id";
}
