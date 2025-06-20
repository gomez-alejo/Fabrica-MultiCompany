<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_invoice extends Model
{
    public function invoice()  {
        return $this->belongsTo(Invoice::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function warehouse()  {
        return $this->belongsTo(Warehouse::class);
    }
}
