<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = ['title', 'content'];
}
