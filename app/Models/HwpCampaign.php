<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HwpCampaign extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['campaign', 'language', 'check'];

    /**
     * lấy url cho chiến dịch
     */
    public function urls()
    {
        return $this->hasMany(HwpUrl::class, 'id_key', 'id');
    }

    /**
     * lấy key word cho chiến dịch
     */
    public function key_word()
    {
        return $this->hasMany(HwpKey::class, 'id_cam', 'id');
    }
}
