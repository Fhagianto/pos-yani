<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    /**
     * fillable
     * 
     * @var array
     */

     protected $fillable = [
        'title','name', 'no_telp', 'address'
     ];
     
}