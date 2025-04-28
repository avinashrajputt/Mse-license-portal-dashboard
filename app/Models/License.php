<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'license_number',
        'issue_date',
        'expiry_date',
        'status',
        'owner_name',
        'email',
        'phone',
    ];
}