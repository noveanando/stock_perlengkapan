<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'item_name', 'item_status', 'category_id', 'type_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function typecategory()
    {
        return $this->belongsTo(Category::class, 'type_category_id');
    }
}
