<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Supplier extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'image',
        'cnpj',
        'phone',
        'name_fantasy'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'description'])
        ->dontSubmitEmptyLogs();
    }
}
