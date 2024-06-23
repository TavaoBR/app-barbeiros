<?php 

namespace Src\GET\Telegram;

class DefaultBot {
 
    protected string $token;
    protected string $chatId;

    public function __construct(){
        $this->token = "7168680151:AAFqWgw4DMCgAe7RSXB2rGzzClaTW45X7m0";
        $this->chatId = "-4267389941";
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