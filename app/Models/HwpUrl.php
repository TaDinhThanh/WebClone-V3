<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HwpKey;
class HwpUrl extends Model
{
    use HasFactory;

    /**
     * lấy key cho theo url 
     */
    public function key_word()
    {
        return $this->belongsTo(HwpKey::class,'id_key','id');
    }
}
