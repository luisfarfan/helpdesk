<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soap_library extends CI_Controller {

    protected $_url = '';
    protected $_option = array();
    protected $_key = '';
    protected $_login = '';

    public function __construct($url = 'http://ws1.pide.gob.pe:9900/rest/services/uddi:3a89f428-5016-11e5-81fd-c2cc99e5a83d/wsdl', $options = array('location' => 'http://ws1.pide.gob.pe/SMSService'), $key = '01BEF2B50A686AAB1317B27BB77B86425F7A9DCF', $login = '6gM0VXFnnmVK') {
        $this->_url = $url;
        $this->_option = $options;
        $this->_key = $key;
        $this->_login = $login;
    }

    public function mensajeria($sender, $subject, $message, $receiver) {

        $client = new SoapClient($this->_url, $this->_option);
        $parametros = array("sender" => $sender, "subject" => $subject, "message" => $message, "receiver" => $receiver, "key" => $this->_key, "login" => $this->_login);

        $result = $client->SendSMS($parametros);
        //var_dump($result);
        return $result;
    }
    
}
