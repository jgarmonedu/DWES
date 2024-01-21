<?php
// How to Create a SOAP Client/Server in PHP (Added Authentification) - Part 02
// https://www.youtube.com/watch?v=6V_myufS89A

class Client {
    private $instance;

    public function __construct() {
        $params = array('location' => 'http://localhost/automobiles/soap-automobiles/service-automobiles-auth.php',
            'uri' => 'urn://localhost/automobiles/soap-automobiles/service-automobiles-auth.php',
            'trace' => 1);
        $this->instance = new SoapClient(null, $params);

        // set the header 
        // https://www.php.net/manual/en/reserved.classes.php
        $auth_params = new stdClass();
        $auth_params->username = 'ies';
        $auth_params->password = 'daw';

        // https://www.php.net/manual/en/class.soapheader.php
        // https://www.php.net/manual/en/class.soapvar.php

        $header_params = new SoapVar($auth_params, SOAP_ENC_OBJECT);
        $header = new SoapHeader('http://localhost/automobiles/soap-automobiles/', 'authenticate', $header_params, false);
        $this->instance->__setSoapHeaders(array($header));

    }
    public function getBrandById($brand) {
        //$this->instance->getBrandsUrl();
        // https://www.php.net/manual/en/soapclient.soapcall.php --> wrap the array arguments in another array
        //return $this->instance->__soapCall('getBrandsUrl',array('', ''));
        try{
            $result = $this->instance->__soapCall('getBrandById',array($brand));
        } catch (SoapFault $fault) {
            echo $fault->getMessage();
        }
        return $result;
    }
    public function getBrandsUrl() {
        //$this->instance->getBrandsUrl();
        // https://www.php.net/manual/en/soapclient.soapcall.php --> wrap the array arguments in another array
        //return $this->instance->__soapCall('getBrandsUrl',array('', ''));
        try{
            $result = $this->instance->__soapCall('getBrandsUrl',array());
            //$result = $this->instance->getBrandsUrl();
        } catch (SoapFault $fault) {
            echo $fault->getMessage();
        }
        return $result;
    }

    public function getModelsByBrand($brand) {
        // https://www.php.net/manual/en/soapclient.soapcall.php --> wrap the array arguments in another array 
        try {
            $result = $this->instance->__soapCall('getModelsByBrand', array($brand));
        } catch (SoapFault $fault) {
            echo $fault->getMessage();
        }
        return $result;
    }
}


