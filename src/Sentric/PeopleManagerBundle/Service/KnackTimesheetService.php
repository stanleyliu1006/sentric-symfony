<?php

namespace Sentric\PeopleManagerBundle\Service;

class KnackTimesheetService {

    protected $knack_PM_APPID;
    protected $knack_PM_APIKey;

    public function __construct($knack_PM_APPID, $knack_PM_APIKey) {
        $this->knack_PM_APPID = $knack_PM_APPID;

        $this->knack_PM_APIKey = $knack_PM_APIKey;
    }

    public function KnackAPIInitial($object) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records?filters=".urlencode("[{\"field\":\"field_168\",\"operator\":\"is\",\"value\":\"Active\",\"field_name\":\"Project Status\"}]"));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_PM_APPID, "X-Knack-REST-API-Key: " . $this->knack_PM_APIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function KnackAPIInitialWithFilter($object,$filter) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records?filters=".$filter);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_PM_APPID, "X-Knack-REST-API-Key: " . $this->knack_PM_APIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function KnackAPIInitialPage($object,$page) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records?page=".$page);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_PM_APPID, "X-Knack-REST-API-Key: " . $this->knack_PM_APIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function KnackAPIPostAdd($object,$jsondata) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_PM_APPID, "X-Knack-REST-API-Key: " . $this->knack_PM_APIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function GetActiveJobs(){
        $filter=urlencode("[{\"field\":\"field_168\",\"operator\":\"is\",\"value\":\"Active\",\"field_name\":\"Project Status\"}]");
        return $this->KnackAPIInitialWithFIlter("object_18",$filter);
    }
    public function GetTimesheets(){
        return $this->KnackAPIInitial("object_5");
    }
    public function GetStatus(){
        return $this->KnackAPIInitial("object_4");
    }
}
