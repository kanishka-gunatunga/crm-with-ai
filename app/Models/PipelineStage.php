<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PipelineStage extends Model
{
    use HasFactory;

    protected $table = 'pipeline_stages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pipeline_id',
        'name',
        'probability',  
    ];

    public function pipeline()
    {
        return $this->belongsTo(Pipeline::class);
    }
}
