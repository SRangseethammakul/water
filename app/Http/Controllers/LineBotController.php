<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class LineBotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reply(Request $request)
    {
        try {
            $strAccessToken = "mPTPwCDDSVAujVGodPG9sRtQVD8/dq7ZYpiGNPY0PwSuAkQNYsX5OuH2mxnhXwwq/lAYnj3Lc8lC9oyF3Tu5rJLcoFQCPwNBs1tCnk1X79jfLfuj0SdQZ382z4+TGitYIgXSx9DEAj/x68j5MA5awgdB04t89/1O/w1cDnyilFU=";
 
            $content = file_get_contents('php://input');
            $arrJson = json_decode($content, true);
            $strUrl = "https://api.line.me/v2/bot/message/reply";
 
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
             
            if($arrJson['events'][0]['message']['text'] == "สวัสดี"){
              $arrPostData = array();
              $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
              $arrPostData['messages'][0]['type'] = "text";
              $arrPostData['messages'][0]['text'] = "สวัสดี ID คุณคือ ".$arrJson['events'][0]['source']['userId'];
            }else if($arrJson['events'][0]['message']['text'] == "ชื่ออะไร"){
              $arrPostData = array();
              $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
              $arrPostData['messages'][0]['type'] = "text";
              $arrPostData['messages'][0]['text'] = "ฉันยังไม่มีชื่อนะ";
            }else if($arrJson['events'][0]['message']['text'] == "ทำอะไรได้บ้าง"){
              $arrPostData = array();
              $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
              $arrPostData['messages'][0]['type'] = "text";
              $arrPostData['messages'][0]['text'] = "ฉันทำอะไรไม่ได้เลย คุณต้องสอนฉันอีกเยอะ";
            }else{
              $arrPostData = array();
              $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
              $arrPostData['messages'][0]['type'] = "text";
              $arrPostData['messages'][0]['text'] = "ฉันไม่เข้าใจคำสั่ง";
            }
             
             
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$strUrl);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($ch);
            curl_close ($ch);
            return response()->json(['status' => 1],200);
        } catch (Exception $e) {
            return response()->json(['status' => 0],200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
