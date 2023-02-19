<?php

namespace App\Http\Controllers;

use App\Models\HwpPost;
use App\Models\HwpUrl;
use Illuminate\Http\Request;

class HwpUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUrl($id_key)
    {
        return HwpUrl::where("id_key", '=', $id_key)->get();
    }

    public function getUrlById($id_url)
    {
        $list_url = HwpUrl::where("id", '=', $id_url)->get()->toArray();
        return json_encode($list_url);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUrlByIdKey($id_key)
    {
        $list_url = HwpUrl::query()
            ->leftJoin('hwp_posts', 'hwp_urls.id', '=', 'hwp_posts.id_url')
            ->where("hwp_urls.id_key", '=', $id_key)->orderBy('hwp_urls.stt', 'asc')
            ->get()->toArray();
        return json_encode($list_url);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUrlByIdKey2($id_key)
    {

        return HwpUrl::where("id_key", '=', $id_key)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HwpUrl  $hwpUrl
     * @return \Illuminate\Http\Response
     */
    public function saveUrl(Request $request, $id_key)
    {
        $body = json_decode($request->getContent());
        for ($j = 0; $j < count($body); $j++) {
            $url = HwpUrl::where('url', '=', $body[$j]->url)
                ->where('id_key', '=', $id_key)
                ->get()->toArray();
            if (count($url) == 0) {
                HwpUrl::query()->insert([
                    'url' => $body[$j]->url,
                    'url_image' => $body[$j]->url_image,
                    "id_key" => $id_key
                ]);
            }
        }
        return array(
            'message' => 'Lưu thành công, đã lưu url vào cơ sở dữ liệu',
            'success' => true
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HwpUrl  $hwpUrl
     */
    public function resetUrl($id_key)
    {
        if (HwpUrl::where('id_key', '=', $id_key)->update(['check' => false])) {
            return array(
                'message' => 'resset url của ' + $id_key + 'thành công',
                'textStatus' => "success"
            );
        } else {
            return array(
                'message' => 'resset url của ' + $id_key + 'thất bại',
                'textStatus' => "success"
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HwpUrl  $hwpUrl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HwpUrl $hwpUrl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HwpUrl  $hwpUrl
     * @return \Illuminate\Http\Response
     */
    public function xoaURLByIdKey($id_key)
    {
        HwpUrl::where('id_key', '=', $id_key)->delete();
        HwpPost::where('id_key', '=', $id_key)->delete();
        return array(["code" => 200, 'message' => 'Success']);
    }
}
