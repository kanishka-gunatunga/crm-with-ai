<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebForm extends Model
{
    use HasFactory;

    protected $table = 'web_forms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uid',
        'title',
        'button_lable',
        'success_action_type',
        'success_action',
        'description',
        'background_color',
        'form_background_color',
        'title_color',
        'submit_btn_color',
        'lable_color',
        'create_lead_enabled',
        'person_attributes',
        'lead_attributes',
        
    ];

    protected $casts = [
        'person_attributes' => 'array',
        'lead_attributes' => 'array'
    ];

}
