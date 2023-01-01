<?php
class EmailAble{
    private static $json;

    public function  __construct($api, $email)
    {
        //setting min configuration
        $url = "https://api.emailable.com/v1/verify?email=$email&api_key=$api";
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        $content = curl_exec($handle);
        if($content !== false){
            EmailAble::$json = json_decode($content, true);
        }else {
            die("API Key Not Response");
        }
    }

    /**
     * @return mixed
     */
    public static function getDomainName()
    {
        return EmailAble::$json['domain'];
    }
    public static function getMXRecord(){
        return EmailAble::$json["mx_record"];
    }
    public static  function getScore(){
        return EmailAble::$json['score'] ;
    }
    public static function getServiceProvider(){
        return EmailAble::$json['smtp_provider'];
    }
    public static  function isDeliverable(){
        if(EmailAble::$json["reason"] != "invalid_domain"){
            return true;
        }else{
            return false;
        }
    }
    public static function getReason()
    {
        return EmailAble::$json['reason'];
    }
    public static function isPublicMail(){
        if(EmailAble::$json["free"] != 1){
            return false;
        }else{
            return true;
        }
    }
}
