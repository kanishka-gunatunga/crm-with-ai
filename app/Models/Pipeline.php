<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pipeline extends Model
{
    use HasFactory;

    protected $table = 'pipelines';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'rotting_days',
        'is_default',  
    ];

    public function stages()
    {
        return $this->hasMany(PipelineStage::class);
    }
}
