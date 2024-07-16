<?php 

namespace Src\Services; 

class Whatsapp 
{

    private string $to;
    private string $body;
    private ?string $image = null;

    public function __construct(string $to, string $body, string $image = null)
    {

        $this->to = $to;
        $this->body = $body;
        $this->image = $image;

    }

    private function url()
    {
      return $_ENV['API_URL_WHATSAPP'];
    }

    private function token()
    {
        return $_ENV['WHATSAPP_TOKEN'];
    }

    private function param()
    {
        $paramentros = [
           'token' => $this->token(),
           'to' => $this->to,
           'body' => $this->body 
        ];

        return $paramentros;
    }

    private function curl()
    {
       $curl = curl_init();
       curl_setopt_array($curl, [
        CURLOPT_URL => $this->url(),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($this->param()),
        CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded"
        ],
       ]);

       $response = curl_exec($curl);
       //$err = curl_error($curl);
       curl_close($curl);

       return $response;
    }

    public function send()
    {
       $this->curl();
    }
    
}