<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['protocol', 'duty_schedule', 'file_storage', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
