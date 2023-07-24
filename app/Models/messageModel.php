<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messageModel extends Model
{
    use HasFactory;
    protected $table = 'message';
    protected $fillable = [
        'full_name',
        'email',
        'subject',
        'message',
    ];
}
