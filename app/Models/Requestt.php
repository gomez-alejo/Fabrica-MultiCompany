<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requestt extends Model
{

    // Relación con empresa, muchas solicitudes pueden pertenecer a una misma empresa
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relación con usuario que creó la solicitud
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}



