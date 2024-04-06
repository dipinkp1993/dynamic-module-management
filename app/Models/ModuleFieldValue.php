<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleFieldValue extends Model
{
    use HasFactory;

    protected $fillable=['module_field_value'];

    public function field() 
    {
        return $this->belongsTo(ModuleField::class, 'module_field_id');
    }
}
