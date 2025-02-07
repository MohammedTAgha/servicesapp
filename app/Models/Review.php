<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable =['reting','comment'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
 
}
