<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    // Relación con empresa, muchas solicitudes pueden pertenecer a una misma empresa
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    // Relación con usuario que creó la solicitud
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }
}



