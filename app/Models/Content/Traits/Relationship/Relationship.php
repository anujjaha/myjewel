<?php namespace App\Models\Order\Traits\Relationship;

use App\Models\Access\User\User;
use App\Models\OrderItem\OrderItem;

trait Relationship
{
	public function user()
	{
	    return $this->belongsTo(User::class);
	}

	public function order_items()
	{
	    return $this->hasMany(OrderItem::class);
	}
}