<?php

namespace App\Http\Controllers;

use App\Models\HwpCampaign;
use Illuminate\Http\Request;
use App\Http\Resources\HwpCampaignResource;

class HwpCampaignController extends Controller
{
    /**
     * Đưa ra danh sách chiến dịch
     *
     * @return \Illuminate\Http\Response
     */
    public function getCam()
    {
        return HwpCampaignResource::collection(HwpCampaign::all());
    }

    /**
     * Thực hiện lưu chiến dịch mới tạo vào trong vùng nhớ
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveCam(Request $request)
    {
        try {
            foreach ($request->data as $value) {
                if (HwpCampaign::where('campaign', '=', $value['campaign'])->count() == 0) {
                    HwpCampaign::create([
                        "campaign" => $value['campaign'],
                        "language" => $value['language'],
                        "check" => false
                    ]);
                };
            }
            return [
                'message' => 'Lưu thành công, đã lưu chiến dịch vào cơ sở dữ liệu',
                'textStatus' => "success"
            ];    
        } catch (\Throwable $th) {
            return [
                'message' => 'Lưu thất bại',
                'textStatus' => "error"
            ];  
        }
        
    }

    /**
     * Thực hiện cập nhật trạng thái đang chạy một chiến dịch cụ thể trong vùng nhớ
     *
     * @param  \App\Models\HwpCampaign  $hwpCampaign
     * @return \Illuminate\Http\Response
     */
    public function updateStatusCam(HwpCampaign $hwpCampaign)
    {
        if ($hwpCampaign->update(['check' => true])) {
            return [
                'message' => 'Chiến dịch này đang được chạy',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Cập nhật trạng thái thất bại',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Thực hiện cập nhật trạng thái không chạy một chiến dịch cụ thể trong vùng nhớ
     *
     * @param  \App\Models\HwpCampaign  $hwpCampaign
     * @return \Illuminate\Http\Response
     */
    public function resetStatusCam(HwpCampaign $hwpCampaign)
    {
        if ($hwpCampaign->update(['check' => false])) {
            return [
                'message' => 'Cập nhật thành công',
                'textStatus' => "success"
            ];
        } else {
            return [
                'message' => 'Cập nhật thất bại',
                'textStatus' => "error"
            ];
        }
    }

    /**
     * Thực hiện đưa một chiến dịch cụ thể ra khỏi vùng nhớ
     *
     * @param  \App\Models\HwpCampaign  $hwpCampaign
     * @return \Illuminate\Http\Response
     */
    
    public function deleteCam(HwpCampaign $hwpCampaign)
    {
        try {
            foreach ($hwpCampaign->key_word()->get() as $index => $keyword) {
                foreach ($keyword->urls()->get() as $jdex => $url) {
                    $url->delete();
                }
                foreach ($keyword->webs()->get() as $jdex => $post) {
                    $post->delete();
                }
                foreach ($keyword->yts()->get() as $jdex => $video) {
                    $video->delete();
                }
                $keyword->delete();
            }
            $hwpCampaign->delete();
            return [
                'message' => 'Xóa thành công',
                'textStatus' => "success"
            ];
        } catch (\Throwable $th) {
            return [
                'message' => 'Xóa thất bại',
                'textStatus' => "error"
            ];
        }
    }
}
