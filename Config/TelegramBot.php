<?php 

namespace Config; 

class TelegramBot {

    protected string $token;
    protected string $chatId;
    protected string $message;
    
    public function __construct(string $token, string $chatId, string $message){
        $this->token = $token;
        $this->chatId = $chatId;
        $this->message = $message;
    }

    private function data()
    {
       $data = [
        "chat_id" => $this->chatId,
        "text" => $this->message
       ];

       return $data;
    }

    private function url()
    {

       $url = "http://api.telegram.org/bot{$this->token}/sendMessage?";
       return $url;
    }

    public function send()
    {
    
       $response = file_get_contents($this->url().http_build_query($this->data()));
       return $response;   

    }

}