<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyFirstModel extends Model
{
    use HasFactory;

    protected $table = "test";

    protected $fillable = ['id', 'name', 'last_name'];
}
