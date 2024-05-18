<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Positions extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'weight',
        'discount',
    ];

    protected $appends = [
        'img',
    ];

    public function getImgAttribute()
    {
        $appUrl = env('APP_URL');
        return "$appUrl/uploads/positions/$this->id.webp";
    }

}
