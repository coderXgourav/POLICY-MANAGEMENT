<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyAssignToGroupModel extends Model
{
    use HasFactory;
    protected $table = "policy_assign_to_group";
    protected $primaryKey = "policy_assign_to_group_id";
}
