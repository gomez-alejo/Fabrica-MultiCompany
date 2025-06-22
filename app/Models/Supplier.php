<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    public function products() {
        $this->hasMany(Product::class); 
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function person() {
        return $this->benlongsTo(Person::class);
    }

} 
