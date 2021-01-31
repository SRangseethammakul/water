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
            $datas = file_get_contents('php://input');
            /*Decode Json From LINE Data Body*/
            $deCode = json_decode($datas,true);
        
            $replyToken = $deCode['events'][0]['replyToken'];
            $userId = $deCode['events'][0]['source']['userId'];
            $text = $deCode['events'][0]['message']['text'];
        
            $messages = [];
            $messages['replyToken'] = $replyToken;
            $messages['messages'][0] = getFormatTextMessage("เอ้ย ถามอะไรก็ตอบได้");

            $LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
            $LINEDatas['token'] = "mPTPwCDDSVAujVGodPG9sRtQVD8/dq7ZYpiGNPY0PwSuAkQNYsX5OuH2mxnhXwwq/lAYnj3Lc8lC9oyF3Tu5rJLcoFQCPwNBs1tCnk1X79jfLfuj0SdQZ382z4+TGitYIgXSx9DEAj/x68j5MA5awgdB04t89/1O/w1cDnyilFU=";
            $results = sentMessage($encodeJson,$LINEDatas);
            return response()->json(['status' => 1],200);
        } catch (Exception $e) {
            return response()->json(['status' => 0],200);
        }
    }
    public function getFormatTextMessage($text)
	{
		$datas = [];
		$datas['type'] = 'text';
		$datas['text'] = $text;

		return $datas;
	}
    public function sentMessage($encodeJson,$datas)
	{
		$datasReturn = [];
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $datas['url'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $encodeJson,
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer ".$datas['token'],
		    "cache-control: no-cache",
		    "content-type: application/json; charset=UTF-8",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    $datasReturn['result'] = 'E';
		    $datasReturn['message'] = $err;
		} else {
		    if($response == "{}"){
			$datasReturn['result'] = 'S';
			$datasReturn['message'] = 'Success';
		    }else{
			$datasReturn['result'] = 'E';
			$datasReturn['message'] = $response;
		    }
		}

		return $datasReturn;
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
