<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    // Relación con empresa
    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function branches(){
        return $this->belongsTo(Branch::class);
    }
    // Relación con producto
    public function invoiceProducts(){
        return $this->hasMany(InvoiceProduct::class);
    }
    // Usuario que creó la factura
    public function person(){
        return $this->belongsTo(User::class);
    }
}

