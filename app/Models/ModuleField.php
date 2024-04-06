<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleField extends Model
{
    use HasFactory;

    public function module() {
        return $this->belongsTo(Module::class, 'module_id');
    }
    
    public function field() {
        return $this->belongsTo(Field::class, 'field_id','field_id');
    }
    
    public function values() {
        return $this->hasMany(ModuleFieldValue::class, 'module_field_id');
    }
}
