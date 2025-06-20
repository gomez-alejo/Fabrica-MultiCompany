<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_Product extends Model
{
    //
    public function request() {
       return $this->belongsTo(Request::class);
    }

    public function product() {
        return $this->benlongsTo(Product::class);
    }

    public function warehouse() {
        return $this->benlongsTo(Warehouse::class);
    }
}
