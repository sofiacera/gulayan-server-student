<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantModel extends Model
{
    use HasFactory;

    protected $table = 'plants';

    protected $fillable = [
        'name',
        'variety',
        'notes',
        'date_planted',
        'seedling_count',
        'batch_name',
        'starting_fund',
        'seedling_source'
    ];

    protected $casts = [
        'date_planted' => 'date',
        'seedling_count' => 'integer',
        'starting_fund' => 'decimal:2',
    ];
}
