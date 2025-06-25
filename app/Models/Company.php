<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
   use HasFactory;

   protected $fillable = [
      'name',
      'nit',
      'address',
      'phones',
      'website',
      'email',
   ];

   public function invoices() {
      return $this->hasMany(Invoice::class); 
   }

   public function branches() {
      return $this->hasMany(Branch::class); 
   }

   public function suppliers() {
      return $this->hasMany(Supplier::class); 
   }

   public function people() {
      return $this->hasMany(Person::class); 
   }

   public function requests() {
      return $this->hasMany(Requestt::class); 
   }

   public function warehouses() {
      return $this->hasMany(Warehouse::class); 
   }

   public function products() {
      return $this->hasMany(Product::class); 
   }

   public function stocks() {
      return $this->hasMany(Stock::class); 
   }

   public function users() {
      return $this->hasMany(User::class); 
   }
} 
