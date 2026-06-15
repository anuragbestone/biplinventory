<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMaster extends Model
{
    use HasFactory;

    protected $table = "user_master";
    
    protected $fillable = [

        "full_name",
        "email",
        "contact_number",
        "whatsapp_number",
        "password",
        "role_id"
        
    ];

    protected $hidden = [
        "password"
    ];

    protected $casts = [
        "is_active" => "boolean",
        "created_at" => "datetime",
        "updated_at" => "datetime"
    ];

    public function setPasswordAttribute($value) {
        $this->attributes["password"] = Hash::make($value);
    }
}