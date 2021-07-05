<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class WAController extends Controller
{

	public function send()
	{
	$message = "Mari Pulang";
	$this->sendWa($message,'6281385282208');			
	}

    public function sendWa($message,$destination)
	{
		$curl = curl_init();
		$token = "EiAM1JO0FD7vMBsqP5gERYBbQEn7rdm9QD3QekEXvgiWgvXwvsiC6gCS7lNizJUu";
		$data = [
		    'phone' => $destination,
		    'message' => $message,
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER,
		    array(
		        "Authorization:".$token,
		    )
		);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_URL, "https://sambi.wablas.com/api/send-message");
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($curl);
		curl_close($curl);

		echo "<pre>";
		print_r($result);
        echo "</pre>";
	}
}
