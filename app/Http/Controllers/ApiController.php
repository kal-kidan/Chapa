<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function soapRequest($age){
     try {
        $xml = "<?xml version='1.0' encoding='utf-8'?>
        <soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/'>
          <soap:Body>
            <NumberToWords xmlns='http://www.dataaccess.com/webservicesserver/'>
              <ubiNum>$age</ubiNum>
            </NumberToWords>
          </soap:Body>
        </soap:Envelope>";
        $response = Http::withHeaders(['Content-Type' => 'text/xml; charset=utf-8'])->send('POST', 'http://www.dataaccess.com/webservicesserver/numberconversion.wso', [
            'body' => $xml,
        ]);
        $body =  $response->body();  
        return "your age is $body"; 
     } catch (Exception $e) {
         echo $e->getMessage();
     }
    }
}
