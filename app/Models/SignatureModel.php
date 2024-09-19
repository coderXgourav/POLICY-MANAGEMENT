<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignatureModel extends Model
{
    use HasFactory;
    protected $table = "signature";
    protected $primaryKey = "signature_id";
}