<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidRegistration extends Model
{
    use HasFactory;

    protected $table = 'covid_registrations';

    protected $fillable = [
        'nid',
        'name',
        'email',
        'vaccine_center_id',
        'status',
        'scheduled_date',
    ];

    public function vaccineCenter()
    {
        return $this->belongsTo(VaccineCenter::class, 'vaccine_center_id');
    }
}
