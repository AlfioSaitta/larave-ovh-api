<?php

namespace Rafael\OvhApi\Service\Ovh;

use Ovh\Api;
use GuzzleHttp\Client;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OvhConn
 *
 * @author rafael
 */
class OvhConn {
    
    private $client;
    private $conn = null;
    
    public function __construct() 
    {
        $client = new \GuzzleHttp\Client();

        $guzzleClient = new \GuzzleHttp\Client(array(
            'timeout' => 60,
        ));
        
        $this->client = $guzzleClient;
//        $client->setClient($guzzleClient);
//        $this->client = new Client();        ;
//        $this->client->setDefaultOption('timeout', 60);
//        $this->client->setDefaultOption('headers', array('User-Agent' => 'api_client') );
        $this->conn();        
    }

    private function conn() 
    {        
        if (!$this->conn) {            
            $this->conn = new Api(
                        config('ovhapi.ovh_config.applicationKey'),
                        config('ovhapi.ovh_config.applicationSecret'),
                        config('ovhapi.ovh_config.end-points.ca'),
                        config('ovhapi.ovh_config.consumer_key'),
                        $this->client
                    );
        }
        
        return $this->conn;
    }
    
    public function getConn()
    {
        return $this->conn;
    }
}
