<?php

namespace App\Http\Controllers;

use App\Models\HwpPost;
use App\Models\HwpUrl;
use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class HwpPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetailPost($id)
    {
        $detail = HwpPost::where('id', '=', $id)->get()->toArray();
        return json_encode($detail);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveWeb(Request $request)
    {
        try {
            //viet->eng
            $tr_vi_en = new GoogleTranslate('en', 'vi');
            //eng->japan
            $tr_en_ja = new GoogleTranslate('ja', 'en');
            //japan->france
            $tr_ja_fr = new GoogleTranslate('fr', 'ja');
            //france->viet
            $tr_fr_vi = new GoogleTranslate('vi', 'fr');
            $body = json_decode($request->getContent());
            for ($j = 0; $j < count($body); $j++) {
                //dịch sang tiếng Anh
                $desc = $body[$j]->url_description;
                $desc = $tr_vi_en->translate($desc);
                //dịch sang tiếng nhật
                $desc = $tr_en_ja->translate($desc);
                //dịch sang tiếng pháp
                $desc = $tr_ja_fr->translate($desc);
                //dịch sang tiếng việt
                $desc = $tr_fr_vi->translate($desc);
                // $url = HwpUrl::where('url', '=', $body[$j]->url)
                //     ->where('id_key', '=', $body[$j]->id_key)
                //     ->get()->toArray();
                // if (count($url) == 0) {
                    HwpUrl::query()->insert([
                        "url" => $body[$j]->url,
                        "url_image" => $body[$j]->url_image,
                        "url_title" => Addslashes($body[$j]->url_title),
                        "url_description" => Addslashes($desc),
                        "ky_hieu" => $body[$j]->ky_hieu,
                        "id_key" => $body[$j]->id_key,
                        "stt" => $body[$j]->stt
                    ]);
                // }    
            }
            return [
                'message' => 'Lưu thành công, đã lưu Url web vào cơ sở dữ liệu',
                'success' => true
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Lưu không thành công url web',
                'success' => true
            ];
        }
    }

    public function saveVideo(Request $request)
    {
        try {
            // viet->eng
            $tr_vi_en = new GoogleTranslate('en', 'vi');
            //eng->japan
            $tr_en_ja = new GoogleTranslate('ja', 'en');
            //japan->france
            $tr_ja_fr = new GoogleTranslate('fr', 'ja');
            //france->viet
            $tr_fr_vi = new GoogleTranslate('vi', 'fr');
            $body = json_decode($request->getContent());
            for ($j = 0; $j < count($body); $j++) {
                // dịch sang tiếng Anh
                $desc = $body[$j]->url_description;
                $desc = $tr_vi_en->translate($desc);
                //dịch sang tiếng nhật
                $desc = $tr_en_ja->translate($desc);
                //dịch sang tiếng pháp
                $desc = $tr_ja_fr->translate($desc);
                //dịch sang tiếng việt
                $desc = $tr_fr_vi->translate($desc);
                // $url = HwpUrl::where('url', '=', $body[$j]->url)
                //     ->where('id_key', '=', $body[$j]->id_key)
                //     ->get()->toArray();
                // if (count($url) == 0) {
                    HwpUrl::query()->insert([
                        "url" => $body[$j]->url,
                        "url_title" => Addslashes($body[$j]->url_title),
                        "url_description" => Addslashes($desc),
                        "ky_hieu" => $body[$j]->ky_hieu,
                        "id_key" => $body[$j]->id_key,
                        "stt" => $body[$j]->stt
                    ]);
                // }
            }
            return [
                'message' => 'Lưu thành công, đã lưu video vào cơ sở dữ liệu',
                'success' => true
            ];
        } catch (\Exception $e) {
            return [
                'message' => 'Lưu không thành công url Video',
                'success' => true
            ];
        }
    }


    public function saveImage(Request $request)
    {
        try {
            //viet->eng
            $tr_vi_en = new GoogleTranslate('en', 'vi');
            //eng->japan
            $tr_en_ja = new GoogleTranslate('ja', 'en');
            //        japan->france
            $tr_ja_fr = new GoogleTranslate('fr', 'ja');
            //france->viet
            $tr_fr_vi = new GoogleTranslate('vi', 'fr');
            $body = json_decode($request->getContent());
            for ($j = 0; $j < count($body); $j++) {
                //dịch sang tiếng Anh
                $desc = $body[$j]->url_description;
                $desc = $tr_vi_en->translate($desc);
                //dịch sang tiếng nhật
                $desc = $tr_en_ja->translate($desc);
                //dịch sang tiếng pháp
                $desc = $tr_ja_fr->translate($desc);
                //dịch sang tiếng việt
                $desc = $tr_fr_vi->translate($desc);
                // $url = DB::table('hwp_urls')->where('url', '=', $body[$j]->url)
                // ->where('id_key', '=', $body[$j]->id_key)
                // ->get()->toArray();
                // if(count($url) == 0) {
                HwpUrl::query()->insert([
                    "url" => $body[$j]->url,
                    "url_image" => $body[$j]->url_image,
                    "url_title" => Addslashes($body[$j]->url_title),
                    "url_description" => Addslashes($desc),
                    "ky_hieu" => $body[$j]->ky_hieu,
                    "id_key" => $body[$j]->id_key,
                    "stt" => $body[$j]->stt
                ]);
                // }

            }
            return Addslashes($desc);
        } catch (\Exception $e) {
            return array('code' => 500, 'message' => 'k lưu được image');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HwpPost  $hwpPost
     * @return \Illuminate\Http\Response
     */
    public function edit(HwpPost $hwpPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HwpPost  $hwpPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HwpPost $hwpPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HwpPost  $hwpPost
     * @return \Illuminate\Http\Response
     */
    public function xoaPostByIdKey($id_key)
    {
        HwpPost::where('id_key', '=', $id_key)->delete();
        return array(["code" => 200, 'message' => 'Success']);
    }
}
