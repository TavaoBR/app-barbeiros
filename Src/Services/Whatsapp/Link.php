<?php

namespace Src\Services\Whatsapp;

class Link extends Whatsapp 
{

    public function __construct(string $to, string $link)
    {
        $this->to = $to; 
        $this->link = $link; 
    }

    private function param()
    {
        $param = [
            "messageData" => [
                "to" => "{$this->to}@s.whatsapp.net",
                "textWithLink" => "{$this->link}"
            ]
        ];

        return $param;
    }

    public function send()
    {
            $curl = curl_init(); 
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://{$this->host}/rest/sendMessage/{$this->instanceToken}/sendLinkPreview",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($this->param()),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer {$this->token}"
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
    }

}