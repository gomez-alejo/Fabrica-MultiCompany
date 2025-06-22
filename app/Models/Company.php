<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
      public function invoices() {
         $this->hasMany(Invoice::class); 
      }

      public function branches() {
      $this->hasMany(Branch::class); 
      }

      public function suppliers() {
         $this->hasMany(Supplier::class); 
      }

      public function people() {
         $this->hasMany(Person::class); 
      }

      public function requests() {
         $this->hasMany(Requestt::class); 
      }

      public function warehouses() {
         $this->hasMany(Warehouse::class); 
      }

      public function products() {
         $this->hasMany(Product::class); 
      }

      public function stocks() {
         $this->hasMany(Stock::class); 
      }

      public function users() {
         $this->hasMany(User::class); 
      }
} 
