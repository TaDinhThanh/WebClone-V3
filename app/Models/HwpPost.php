<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HwpPost extends Model
{
    use HasFactory;
    /**
     * Khóa chính liên kết với bảng hwp_posts
     *
     * @var string
     */
    protected $primaryKey = 'ID';
}
