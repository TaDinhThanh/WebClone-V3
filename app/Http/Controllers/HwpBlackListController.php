<?php

namespace App\Http\Controllers;

use App\Http\Resources\HwpBlackListResource;
use App\Models\HwpBlackList;
use Illuminate\Http\Request;

class HwpBlackListController extends Controller
{
    /**
     * Hiển thị danh sách blacklist theo id cam
     * 
     * @var $id_cam
     * @return \Illuminate\Http\Response
     */
    public function getBlackListByIdCam($id_cam)
    {
        return HwpBlackListResource::collection(HwpBlackList::where("id_cam", '=', $id_cam)->get());
    }

    /**
     * Hiển thị tất cả blacklist
     *
     * @return \Illuminate\Http\Response
     */
    public function getBlackList()
    {
        return HwpBlackListResource::collection(HwpBlackList::all());
    }

    /**
     * Tạo một blacklist mới vào csdl
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveBlackList(Request $request)
    {
        try {
            foreach ($request->data as $value) {
                if (HwpBlackList::where('domain', '=', $value['domain'])->count() == 0) {
                    HwpBlackList::create([
                        "domain" => $value['domain'],
                        "loai" => $value['loai'],
                    ]);
                };
            }
            return [
                'message' => 'Lưu thành công, đã lưu black domain vào cơ sở dữ liệu',
                'textStatus' => "success"
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Lưu thất bại',
                'textStatus' => "success"
            ];
        }
    }

    /**
     * Tạo một blacklist theo id cam mới vào csdl
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveBlackListByIdCam(Request $request, $id_cam)
    {

        try {
            foreach ($request->data as $value) {
                if (HwpBlackList::where('domain', '=', $value['domain'])->where('id_cam', '=', $id_cam)->count() == 0) {
                    HwpBlackList::create([
                        "domain" => $value['domain'],
                        "loai" => $value['loai'],
                        'id_cam' => $id_cam
                    ]);
                };
            }
            return [
                'message' => 'Lưu thành công, đã lưu black domain vào cơ sở dữ liệu',
                'textStatus' => "success"
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Lưu thất bại',
                'textStatus' => "success"
            ];
        }
    }

    /**
     * Xóa một blacklist ra khỏa database
     *
     * @param  \App\Models\HwpBlackList  $hwpBlackList
     * @return \Illuminate\Http\Response
     */
    public function xoaBlackKey(HwpBlackList $black_list)
    {
        if ($black_list->delete()) {
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

    /**
     * 
     *
     * @param  \App\Models\HwpBlackList  $hwpBlackList
     * @return \Illuminate\Http\Response
     */
    public function xoaAllBlackKey($id_cam)
    {
        if (HwpBlackList::where('id_cam', '=', $id_cam)->delete()) {
            return [
                'message' => 'Xóa tất cả BlackList thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Xóa Key Google thất bại',
                'textStatus' => "success"
            ];
        }
    }
}
