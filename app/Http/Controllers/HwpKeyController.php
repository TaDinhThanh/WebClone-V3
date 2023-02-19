<?php

namespace App\Http\Controllers;

use App\Models\HwpKey;
use App\Models\HwpPost;
use App\Models\HwpUrl;
use Illuminate\Http\Request;

class HwpKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKyHieu(HwpKey $key)
    {
        return $key;
    }

    /**
     * Display a listing of the resource.
     * @param $id_cam
     * @return \Illuminate\Http\Response
     */
    public function getKeyByIdCam($id_cam)
    {
        return HwpKey::where("id_cam", '=', $id_cam)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIdKey($id_cam)
    {
        return HwpKey::query()->select("id")->where('id_cam', '=', $id_cam)->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKey()
    {
        return HwpKey::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getKeyNoneUrl($id)
    {
        $items = HwpKey::query()
            ->where("id_cam", '=', $id)
            ->get()
            ->toArray();
        $list_id = array();
        foreach ($items as $i) {
            $url = HwpUrl::query()
                ->select('ky_hieu')
                ->where('id_key', '=', $i->id)->get()->toArray();

            $count = 0;
            foreach ($url as $u) {
                if ($u->ky_hieu == 'w') {
                    $count++;
                    break;
                }
            }
            if ($count == 0) {
                $list_id[] = $i;
            }
        }
        return json_encode($list_id);
    }

    public function findLikeKey($name)
    {
        return HwpKey::where('ten', 'like', '%' . $name . '%')->get();
    }

    public function getDataIdHaveVideo($id_cam)
    {
        $video = HwpUrl::where('ky_hieu', 'y')->get();
        $key_video = [];
        foreach ($video as $key => $value) {
            if ($value->key_word()->where("id_cam", $id_cam)->count() != 0) {
                array_push($key_video, ['id' => $value->key_word->id]);
            }
        }
        return $key_video;
    }

    public function getDataIdHaveUrlGoogle($id_cam)
    {
        $google = HwpUrl::where('ky_hieu', 'w')->get();
        $key_google = [];
        foreach ($google as $key => $value) {
            if ($value->key_word()->where("id_cam", $id_cam)->count() != 0) {
                array_push($key_google, ['id' => $value->key_word->id]);
            }
        }
        return $key_google;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveKey(Request $request)
    {
        foreach ($request->data as $value) {
            if (HwpKey::where('ten', '=', $value['ten'])->count() == 0) {
                $url_key = $value['tien_to'] . " " . $value['ten'] . " " . $value['hau_to'] . "-vi-cb";
                HwpKey::create([
                    'tien_to' => $value['tien_to'],
                    'ten' => $value['ten'],
                    'hau_to' => $value['hau_to'],
                    'url_key_cha' => str_slug($url_key),
                    'key_con_1' => $value['key_1'],
                    'url_key_con_1' => $value['url_key_1'],
                    'key_con_2' => $value['key_2'],
                    'url_key_con_2' => $value['url_key_2'],
                    'key_con_3' => $value['key_3'],
                    'url_key_con_3' => $value['url_key_3'],
                    'key_con_4' => $value['key_4'],
                    'url_key_con_4' => $value['url_key_4'],
                    'top_view_1' => $value['top_view_1'],
                    'url_top_view_1' => $value['url_top_view_1'],
                    'top_view_2' => $value['top_view_2'],
                    'url_top_view_2' => $value['url_top_view_2'],
                    'top_view_3' => $value['top_view_3'],
                    'url_top_view_3' => $value['url_top_view_3'],
                    'top_view_4' => $value['top_view_4'],
                    'url_top_view_4' => $value['url_top_view_4'],
                    'top_view_5' => $value['top_view_5'],
                    'url_top_view_5' => $value['url_top_view_5'],
                    'ky_hieu' => $value['ky_hieu'],
                    'id_list_vd' => $value['id_list_vd']
                ]);
            };
        }
        return [
            'message' => 'Lưu thành công, đã lưu key word vào cơ sở dữ liệu',
            'textStatus' => "success"
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveKeyByIdCam(Request $request, $id_cam)
    {
        foreach ($request->data as $value) {
            if (HwpKey::where('ten', '=', $value['ten'])->where('id_cam', $id_cam)->count() == 0) {
                $url_key = $value['tien_to'] . " " . $value['ten'] . " " . $value['hau_to'] . "-vi-cb";
                HwpKey::create([
                    'tien_to' => $value['tien_to'],
                    'ten' => $value['ten'],
                    'hau_to' => $value['hau_to'],
                    'url_key_cha' => str_slug($url_key),
                    'id_cam' => $id_cam,
                    'key_con_1' => $value['key_1'],
                    'url_key_con_1' => $value['url_key_1'],
                    'key_con_2' => $value['key_2'],
                    'url_key_con_2' => $value['url_key_2'],
                    'key_con_3' => $value['key_3'],
                    'url_key_con_3' => $value['url_key_3'],
                    'key_con_4' => $value['key_4'],
                    'url_key_con_4' => $value['url_key_4'],
                    'top_view_1' => $value['top_view_1'],
                    'url_top_view_1' => $value['url_top_view_1'],
                    'top_view_2' => $value['top_view_2'],
                    'url_top_view_2' => $value['url_top_view_2'],
                    'top_view_3' => $value['top_view_3'],
                    'url_top_view_3' => $value['url_top_view_3'],
                    'top_view_4' => $value['top_view_4'],
                    'url_top_view_4' => $value['url_top_view_4'],
                    'top_view_5' => $value['top_view_5'],
                    'url_top_view_5' => $value['url_top_view_5'],
                    'ky_hieu' => $value['ky_hieu'],
                    'id_list_vd' => $value['id_list_vd']
                ]);
            };
        }
        return [
            'message' => 'Lưu thành công, đã lưu key word vào cơ sở dữ liệu',
            'textStatus' => "success"
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\HwpKey  $hwpKey
     * @return \Illuminate\Http\Response
     */
    public function resetKey(HwpKey $key)
    {
        if ($key->update(['check' => false])) {
            return [
                'message' => 'Reset thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Reset thất bại',
                'textStatus' => "success"
            ];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\HwpKey  $hwpKey
     * @return \Illuminate\Http\Response
     */
    public function updateKey(HwpKey $hwpKey)
    {
        if ($hwpKey->update(['check' => true])) {
            return [
                'message' => 'Reset thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Reset thất bại',
                'textStatus' => "success"
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HwpKey  $hwpKey
     * @return \Illuminate\Http\Response
     */
    public function xoaKey(HwpKey $hwpKey)
    {
        $hwpKey->delete();
        HwpUrl::where("id_key", '=', $hwpKey->id)->delete();
        HwpPost::where("id_key", '=', $hwpKey->id)->delete();
        return array(["code" => 200, 'message' => 'Success']);
    }

    public function xoaAllKey($id_cam)
    {
        $list_key = HwpKey::query()->where("id_cam", '=', $id_cam)->get();
        if (collect($list_key)->count() != 0) {
            foreach ($list_key as $key) {
                HwpUrl::where('id_key', '=', $key->id)->delete();
                HwpPost::where('id_key', '=', $key->id)->delete();
            }
        }
        HwpKey::where('id_cam', '=', $id_cam)->delete();

        return array(["code" => 200, 'message' => 'Success']);
    }
}
