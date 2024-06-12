<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
    ];

    protected $appends = [
        'user',
        'positions',
    ];

    protected $casts = [
        'created_at' => 'datetime:H\:i d.m.Y',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Positions::class, 'order_positions', 'order_id', 'position_id');
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getPositionsAttribute()
    {
        return $this->positions()->get();
    }

    public static function transformCollection($orders)
    {
        $orders->getCollection()->transform(function ($order) {
            $positionIds = $order->positions->pluck('id')->toArray();
            $newOrder = new \stdClass();
            $newOrder->id = $order->id;
            $newOrder->user_id = $order->user_id;
            $newOrder->address = $order->address;
            $newOrder->created_at = $order->created_at->format('H:i d.m.Y');
            $newOrder->user = $order->user;
            $newOrder->positions = $positionIds;

            return $newOrder;
        });

        return $orders;
    }
}
