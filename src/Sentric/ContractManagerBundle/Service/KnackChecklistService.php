<?php

namespace Sentric\ContractManagerBundle\Service;

class KnackChecklistService {

    protected $knack_checklistAPPID;
    protected $knack_checklistAPIKey;

    public function __construct($knack_ChecklistAPPID, $knack_ChecklistAPIKey) {
        $this->knack_checklistAPPID = $knack_ChecklistAPPID;

        $this->knack_checklistAPIKey = $knack_ChecklistAPIKey;
    }

    public function KnackAPIInitial($object) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_checklistAPPID, "X-Knack-REST-API-Key: " . $this->knack_checklistAPIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function KnackAPIInitialPage($object,$page) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records?page=".$page);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_checklistAPPID, "X-Knack-REST-API-Key: " . $this->knack_checklistAPIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function KnackAPIPostAdd($object,$jsondata) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.knackhq.com/v1/objects/".$object."/records");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "X-Knack-Application-Id: " . $this->knack_checklistAPPID, "X-Knack-REST-API-Key: " . $this->knack_checklistAPIKey));
        return json_decode(curl_exec($ch));
    }
    
    public function GetContract(){
        return $this->KnackAPIInitial("object_1");
    }
    public function GetQuestionTitle(){
        return $this->KnackAPIInitial("object_39");
    }
    public function GetQuestion(){
        return $this->KnackAPIInitial("object_37");
    }
    public function GetQuestionWithPage($page){
        return $this->KnackAPIInitialPage("object_37",$page);
    }
    public function GetAnswer(){
        return $this->KnackAPIInitial("object_38");
    }
    public function GetCheckList(){
        return $this->KnackAPIInitial("object_47");
    }  
    public function GetChecklistWithPage($page){
        return $this->KnackAPIInitialPage("object_47",$page);
    }    
    public function GetCheckListCategory(){
        return $this->KnackAPIInitial("object_48");
    }  
}
