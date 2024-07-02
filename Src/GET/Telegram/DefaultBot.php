<?php 

namespace Src\GET\Telegram;

class DefaultBot {
 
    protected string $token;
    protected string $chatId;

    public function __construct(){
        $this->token = $_ENV['TELEGRAM_TOKEN'];
        $this->chatId = $_ENV['TELEGRAM_ID_CHAT'];
    }
    

    public function token()
    {
      return $this->token;
    }

    public function chatId()
    {
        return $this->chatId;
    }
    
}