<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inode extends Model
{
    use HasFactory;
    //
    protected $table = "inodes";
    public $timestamps = true;
}
