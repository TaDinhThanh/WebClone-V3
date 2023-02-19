<?php

namespace App\Http\Controllers;

use App\Models\HwpTerm;
use Illuminate\Support\Facades\DB;

class BaseController
{
    public static function getListTag()
    {
        $list_tag = cache()->remember('TagController-list_tag_', 2000, function () {
            return HwpTerm::query()
                ->select('slug', 'name')
                ->limit(40)
                ->get()->toArray();
        });
        unset($list_tag[0]);
        unset($list_tag[1]);
        return $list_tag;
    }
}
