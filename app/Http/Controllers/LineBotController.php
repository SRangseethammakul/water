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
 
            $strUrl = "https://api.line.me/v2/bot/message/push";
             
            $arrHeader = array();
            $arrHeader[] = "Content-Type: application/json";
            $arrHeader[] = "Authorization: Bearer {$strAccessToken}";
             
            $arrPostData = array();
            $arrPostData['to'] = "Uc02db7c973632f8cf022824f4e5666dd";
            $arrPostData['messages'][0]['type'] = "text";
            $arrPostData['messages'][0]['text'] = "นี้คือการทดสอบ Push Message";
             
             
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
            return response()->json(['status' => 0],200);
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
