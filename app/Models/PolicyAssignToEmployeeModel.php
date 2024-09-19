<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyAssignToEmployeeModel extends Model
{
    use HasFactory;
    protected $table = "policy_assign_to_employee";
    protected $primaryKey = "policy_assign_to_employee_id";
}