<?php

namespace App\Http\Controllers;

use App\Http\Resources\HwpKeyGoogleResource;
use App\Models\HwpKeyGoogle;
use Illuminate\Http\Request;

class HwpKeyGoogleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllKeyGoogle()
    {
        return HwpKeyGoogleResource::collection(HwpKeyGoogle::where("type", '=', 'google')->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllKeyYoutube()
    {
        return HwpKeyGoogleResource::collection(HwpKeyGoogle::where("type", '=', 'youtube')->get());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKeyGoogle()
    {
        return HwpKeyGoogle::where("type", '=', 'google')->where("count", '<', 100)->limit(1)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKeyYoutube()
    {
        return HwpKeyGoogle::where("type", '=', 'youtube')->where("count", '<', 500)->limit(1)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFirstKeyGoogle()
    {
        return HwpKeyGoogle::where("type", '=', 'google')->where("count", '=', 100)->limit(1)->get();
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFirstKeyYoutube()
    {
        return HwpKeyGoogle::where("type", '=', 'youtube')->where("count", '=', 500)->limit(1)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveKeyGoogle(Request $request)
    {
        try {
            foreach ($request->data as $value) {
                if (HwpKeyGoogle::where('key_api', '=', $value['key_api'])->count() == 0) {
                    HwpKeyGoogle::create([
                        "key_api" => $value['key_api'],
                        "description" => $value['description'],
                        "type" => 'google'
                    ]);
                };
            }
            return [
                'message' => 'L??u th??nh c??ng, ???? l??u key google v??o c?? s??? d??? li???u',
                'textStatus' => "success"
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'L??u th???t b???i',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveKeyYoutube(Request $request)
    {
        try {
            foreach ($request->data as $value) {
                if (HwpKeyGoogle::where('key_api', '=', $value['key_api'])->count() == 0) {
                    HwpKeyGoogle::create([
                        "key_api" => $value['key_api'],
                        "description" => $value['description'],
                        "type" => 'youtube'
                    ]);
                };
            }
            return [
                'message' => 'L??u th??nh c??ng, ???? l??u key youtube v??o c?? s??? d??? li???u',
                'textStatus' => "success"
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'L??u th???t b???i',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Th???c hi???n c???p nh???t key google l??n 100
     *
     * @param  \App\Models\HwpKeyGoogle  $key_gg
     * @return \Illuminate\Http\Response
     */
    public function getNextKeyGoogle(HwpKeyGoogle $key_gg)
    {
        if ($key_gg->update(["count" => 100])) {
            return [
                'message' => 'get next key GG',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'kh??ng next ???????c key GG',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Th???c hi???n c???p nh???t key youtube l??n 500
     *
     * @param  \App\Models\HwpKeyGoogle  $key_yt
     * @return \Illuminate\Http\Response
     */

    public function getNextKeyYoutube(HwpKeyGoogle $key_yt)
    {
        if ($key_yt->update(["count" => 100])) {
            return [
                'message' => 'get next key YT',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'kh??ng next ???????c key YT',
                'textStatus' => "error"
            ];
        }
    }

    public function updateCountKeyGoogle(HwpKeyGoogle $key_gg)
    {
        if ($key_gg->count >= 0 && $key_gg->count < 100) {
            $key_gg->update(["count" => $key_gg->count + 1]);
        } else {
            $key_gg->update(["count" => 100]);
        }
        return [
            'message' => 'Update count google th??nh c??ng',
            'textStatus' => "success"
        ];
    }

    public function updateCountKeyYoutube(HwpKeyGoogle $key_yt)
    {
        if ($key_yt->count >= 0 && $key_yt->count < 100) {
            $key_yt->update(["count" => $key_yt->count + 1]);
        } else {
            $key_yt->update(["count" => 500]);
        }
        return [
            'message' => 'Update count youtube th??nh c??ng',
            'textStatus' => "success"
        ];
    }

    public function resetAllKeyGoogle()
    {
        if (HwpKeyGoogle::where("type", '=', 'google')->update(["count" => 0])) {
            return [
                'message' => 'Reset count google th??nh c??ng',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Reset count google th???t b???i',
                'textStatus' => "success"
            ];
        }
    }

    public function resetAllKeyYoutube()
    {
        if (HwpKeyGoogle::where("type", '=', 'youtube')->update(["count" => 0])) {
            return [
                'message' => 'Reset count youtube th??nh c??ng',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Reset count youtube th???t b???i',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteKeyGoogle(HwpKeyGoogle $key_gg)
    {
        if ($key_gg->delete()) {
            return [
                'message' => 'X??a Key Google th??nh c??ng',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'X??a Key Google th???t b???i',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteKeyYoutube(HwpKeyGoogle $key_yt)
    {
        if ($key_yt->delete()) {
            return [
                'message' => 'X??a Key Youtube th??nh c??ng',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'X??a Key Youtube th???t b???i',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteAllKeyGoogle()
    {
        if (HwpKeyGoogle::where('type', "google")->delete()) {
            return [
                'message' => 'X??a Key Google th??nh c??ng',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'X??a Key Google th???t b???i',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteAllKeyYoutube()
    {
        if (HwpKeyGoogle::where('type', "youtube")->delete()) {
            return [
                'message' => 'X??a Key Youtube th??nh c??ng',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'X??a Key Youtube th???t b???i',
                'textStatus' => "success"
            ];
        }
    }
}
