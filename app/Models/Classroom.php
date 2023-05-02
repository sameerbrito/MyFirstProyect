<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Teacher;

class Classroom extends Model
{
    use HasFactory;

    // Relacion uno a uno
    public function teacher(){
        return $this->hasOne(Teacher::class, "id", "teacher_id");
    }
}
