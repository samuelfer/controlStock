<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'image',
        'value',
        'category_id',
        'quantity',
        'supplier_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    // public function vendas()
    // {
    //     return $this->belongsToMany(Venda::class, 'produto_venda')
    //                 ->withPivot('quantidade', 'valor_unitario', 'valor_total')
    //                 ->withTimestamps();
    // }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'description'])
        ->dontSubmitEmptyLogs();
    }
}
