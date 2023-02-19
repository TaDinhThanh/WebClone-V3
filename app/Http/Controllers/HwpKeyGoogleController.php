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
                'message' => 'Lưu thành công, đã lưu key google vào cơ sở dữ liệu',
                'textStatus' => "success"
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Lưu thất bại',
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
                'message' => 'Lưu thành công, đã lưu key youtube vào cơ sở dữ liệu',
                'textStatus' => "success"
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Lưu thất bại',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Thực hiện cập nhật key google lên 100
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
                'message' => 'không next được key GG',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Thực hiện cập nhật key youtube lên 500
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
                'message' => 'không next được key YT',
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
            'message' => 'Update count google thành công',
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
            'message' => 'Update count youtube thành công',
            'textStatus' => "success"
        ];
    }

    public function resetAllKeyGoogle()
    {
        if (HwpKeyGoogle::where("type", '=', 'google')->update(["count" => 0])) {
            return [
                'message' => 'Reset count google thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Reset count google thất bại',
                'textStatus' => "success"
            ];
        }
    }

    public function resetAllKeyYoutube()
    {
        if (HwpKeyGoogle::where("type", '=', 'youtube')->update(["count" => 0])) {
            return [
                'message' => 'Reset count youtube thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Reset count youtube thất bại',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteKeyGoogle(HwpKeyGoogle $key_gg)
    {
        if ($key_gg->delete()) {
            return [
                'message' => 'Xóa Key Google thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Xóa Key Google thất bại',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteKeyYoutube(HwpKeyGoogle $key_yt)
    {
        if ($key_yt->delete()) {
            return [
                'message' => 'Xóa Key Youtube thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Xóa Key Youtube thất bại',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteAllKeyGoogle()
    {
        if (HwpKeyGoogle::where('type', "google")->delete()) {
            return [
                'message' => 'Xóa Key Google thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Xóa Key Google thất bại',
                'textStatus' => "success"
            ];
        }
    }

    public function deleteAllKeyYoutube()
    {
        if (HwpKeyGoogle::where('type', "youtube")->delete()) {
            return [
                'message' => 'Xóa Key Youtube thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Xóa Key Youtube thất bại',
                'textStatus' => "success"
            ];
        }
    }
}
