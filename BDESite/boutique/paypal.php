<?php

class Paypal{
    
    private $user='sb-zftho528535_api1.business.example.com';
    private $pwd = 'VCUN9YR9CCY87WCU';
    private $signature = 'AsOk0ctu7BTPOcQDYumQFaJWZkruA6Eg78Yo6lCwtIgPeNB-teBahQM1';
    public $endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
    public $errors = array();
    
    public function __construct($user = false, $pwd = false, $signature = false, $prod = false)
    {
        
        if($user){
            $this->user = $user;
        }
        if($pwd){
            $this->user = $pwd;
        }
        if($signature){
            $this->user = $signature;
        }
        if($prod){
            $this->endpoint = str_replace('sandbox.', '', $this->endpoint);
        }
    }
    
    
    public function request($method, $params){
        
        $params = array_merge($params, array(
            'METHOD' => $method,
            'VERSION' => '95',
            'USER' => $this->user,
            'PWD' => $this->pwd,
            'SIGNATURE' => $this->signature
        ));
        
        $params = http_build_query($params);
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->endpoint,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_VERBOSE => 1
            
        ));
        
        $response = curl_exec($curl);
        parse_str($response, $responseArray);
        
        if(curl_errno($curl)){
            
            $this->errors = curl_error($curl);
            curl_close($curl);
            return false;
            
        }else{
            
            if($responseArray['ACK'] == 'Success'){
                
                curl_close($curl);
                return $responseArray;
                
            }else{
                
                $this->errors = curl_error($curl);
                curl_close($curl);
                return false;
                
            }
            
        }
        
    }
    
}

?>