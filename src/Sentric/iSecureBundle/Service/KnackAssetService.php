<?php

namespace Sentric\iSecureBundle\Service;

class KnackAssetService {

    protected $knack_assetAPPID;
    protected $knack_assetAPIKey;

    public function __construct($knack_AssetAPPID, $knack_AssetAPIKey) {
        $this->knack_assetAPPID = $knack_AssetAPPID;

        $this->knack_assetAPIKey = $knack_AssetAPIKey;
    }

    public function KnackAPIInitial($object) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_assetAPPID, "X-Knack-REST-API-Key: " . $this->knack_assetAPIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function GetFunctionalArea(){
        return $this->KnackAPIInitial("object_5");
    }
    public function GetAssetControl(){
        return $this->KnackAPIInitial("object_14");
    }
    public function GetCompliance(){
        return $this->KnackAPIInitial("object_13");
    }
    public function GetControlsApplied(){
        return $this->KnackAPIInitial("object_34");
    }
    public function GetExternalThreat(){
        return $this->KnackAPIInitial("object_33");
    }  
    public function GetInternalThreat(){
        return $this->KnackAPIInitial("object_32");
    } 
    public function GetRiskSource(){
        return $this->KnackAPIInitial("object_31");
    }   
    public function GetAsset(){
        return $this->KnackAPIInitial("object_4");
    }     
}
