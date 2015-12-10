<?php

class ReniecSoapCli extends SoapClient {

    private $dni = NULL;

    public function getDni() {
        return $this->dni;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function __construct($wsdl = "http://ws.pide.gob.pe/reniec/WSDataVerificationBinding?wsdl", $options = array("trace" => 1, "location" => 'http://ws.pide.gob.pe/reniec/WSDataVerificationBinding'), $dni = NULL) {

        $this->setDni($dni);
        parent::__construct($wsdl, $options);
    }

    function getXMLData() {
        $dni = $this->getDni();
        $hash = $this->getHash();
        $str = <<<XML
<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:wsd="WSDataVerification">
   <soapenv:Header/>
   <soapenv:Body>
      <wsd:getDatavalidate soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
         <xmlDocumento xsi:type="xsd:string"><![CDATA[<IN>
        <CONSULTA>
                <DNI>$dni</DNI>
        </CONSULTA>
        <IDENTIFICACION>
                <CODUSER>N00003</CODUSER>
                <CODTRANSAC>5</CODTRANSAC>      
                <CODENTIDAD>03</CODENTIDAD>
                <SESION>$hash</SESION>
        </IDENTIFICACION>
</IN>]]>
</xmlDocumento>
      </wsd:getDatavalidate>
   </soapenv:Body>
</soapenv:Envelope>
XML;
        return $str;
    }

    function __doRequest($request, $location, $action, $version, $one_way = NULL) {
        $dom = new DomDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($this->getXMLData());
        $request = $dom->saveXML();
        return parent::__doRequest($request, $location, $action, $version, $one_way);
    }

    function getHash() {
        $clientHash = new SoapClient("http://ws.pide.gob.pe/reniec/WSAuthenticationBinding/?wsdl", array("trace" => 1, "location" => 'http://ws.pide.gob.pe/reniec/WSAuthenticationBinding'));
        $user = '3405897345';
        $password = '5784905794';
        $result = $clientHash->getTicket($user, $password);
        return $result;
    }

}
