<?php

namespace Sentric\iSecureBundle\Controller;

use Sentric\iSecureBundle\Entity\Asset;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AssetController extends Controller
{
    protected $functionalarealist;
    
    protected $assetlist;
    
    protected $assetcontrollist;
    
    protected $compliancelist;
    
    protected $controlsappliedlist;
    
    protected $externalthreatlist;
    
    protected $internalthreatlist;
    
    protected $risksourcelist;
  
    public function saveAction()
    {   
       /* Initial the List value */ 
        $this->functionalarealist= array();
        $this->assetlist= array();
        $this->assetcontrollist= array();
        $this->controlsappliedlist= array();
        $this->externalthreatlist= array();
        $this->internalthreatlist=array();
        $this->risksourcelist= array();
        $this->compliancelist= array();

       /* Truncate all asset tables */
        $assetservice = $this->get('assetservice');
        $tablelist= array('asset','asset_assetcontrol','asset_compliance','asset_controlsapplied','asset_externalthreat','asset_functionalarea',
            'asset_internalthreat','asset_risksource','assetcontrol','compliance','controlsapplied','externalthreat','functionalarea','internalthreat','risksource');
        $assetservice->TruncateAllData($tablelist);
       
       /* Populate the configuration into tables*/  
       $knackservice = $this->get('knackassetservice'); 
       /* Functional Area Configuration */ 
       $Knack_FunctionalAreaList=$knackservice->GetFunctionalArea();
       for ($i=0; $i<$Knack_FunctionalAreaList->total_records; $i++) {
       $functionalarea=new \Sentric\iSecureBundle\Entity\FunctionalArea();
       $functionalarea->setId($Knack_FunctionalAreaList->records[$i]->id);
       $functionalarea->setFunctionalareaname($Knack_FunctionalAreaList->records[$i]->field_31);
       array_push($this->functionalarealist, $functionalarea);
       }
      $assetservice->SaveFunctionalArea($this->functionalarealist); 
       
       /* Asset Control Configuration */ 
       $Knack_AssetControlList=$knackservice->GetAssetControl();
       for ($i=0; $i<$Knack_AssetControlList->total_records; $i++) {
       $assetcontrol=new \Sentric\iSecureBundle\Entity\AssetControl();
       $assetcontrol->setId($Knack_AssetControlList->records[$i]->id);
       $assetcontrol->setAssetcontrolname($Knack_AssetControlList->records[$i]->field_69);
       array_push($this->assetcontrollist, $assetcontrol);
       }
       $assetservice->SaveAssetControl($this->assetcontrollist); 
       
       /* Compliance Configuration */  
       $Knack_ComplianceList=$knackservice->GetCompliance();
       for ($i=0; $i<$Knack_ComplianceList->total_records; $i++) {
       $compliance=new \Sentric\iSecureBundle\Entity\Compliance();
       $compliance->setId($Knack_ComplianceList->records[$i]->id);
       $compliance->setCompliancename($Knack_ComplianceList->records[$i]->field_67);
       array_push($this->compliancelist, $compliance);
       }
       $assetservice->SaveCompliance($this->compliancelist);            

       /* ControlsApplied Configuration */
       $Knack_ControlsAppliedList=$knackservice->GetControlsApplied();
       for ($i=0; $i<$Knack_ControlsAppliedList->total_records; $i++) {
       $controlsapplied=new \Sentric\iSecureBundle\Entity\ControlsApplied();
       $controlsapplied->setId($Knack_ControlsAppliedList->records[$i]->id);
       $controlsapplied->setControlsappliedname($Knack_ControlsAppliedList->records[$i]->field_163);
       array_push($this->controlsappliedlist, $controlsapplied);
       }
       $assetservice->SaveControlsapplied($this->controlsappliedlist);                 

      /* External Threat Configuration */   
       $Knack_ExternalThreatList=$knackservice->GetExternalThreat();
       for ($i=0; $i<$Knack_ExternalThreatList->total_records; $i++) {
       $externalthreat=new \Sentric\iSecureBundle\Entity\ExternalThreat();
       $externalthreat->setId($Knack_ExternalThreatList->records[$i]->id);
       $externalthreat->setExternalthreatname($Knack_ExternalThreatList->records[$i]->field_162);
       array_push($this->externalthreatlist, $externalthreat);
       }
       $assetservice->SaveExternalThreat($this->externalthreatlist);  
      
       /* Internal Threat Configuration */   
       $Knack_InternalThreatList=$knackservice->GetInternalThreat();
       for ($i=0; $i<$Knack_InternalThreatList->total_records; $i++) {
       $internalthreat=new \Sentric\iSecureBundle\Entity\InternalThreat();
       $internalthreat->setId($Knack_InternalThreatList->records[$i]->id);
       $internalthreat->setInternalthreatname($Knack_InternalThreatList->records[$i]->field_161);
       array_push($this->internalthreatlist, $internalthreat);
       }
       $assetservice->SaveInternalThreat($this->internalthreatlist);  
      
       /* Risk Source Configuration */        
       $Knack_RiskSourceList=$knackservice->GetRiskSource();
       for ($i=0; $i<$Knack_RiskSourceList->total_records; $i++) {
       $risksource=new \Sentric\iSecureBundle\Entity\RiskSource();
       $risksource->setId($Knack_RiskSourceList->records[$i]->id);
       $risksource->setRisksourcename($Knack_RiskSourceList->records[$i]->field_160);
       array_push($this->risksourcelist, $risksource);
       }
       $assetservice->SaveRiskSource($this->risksourcelist);      
       
       
       /* Populate the asset data into tables */
       $Knack_AssetList=$knackservice->GetAsset();
       for ($i=0; $i<$Knack_AssetList->total_records; $i++) { 
      // $createdate = \DateTime::createFromFormat('Y-m-d', $Knack_AssetList->records[$i]->field_21);
       $asset=new \Sentric\iSecureBundle\Entity\Asset();
       $asset->setId($Knack_AssetList->records[$i]->id);
       $asset->setAssetnumberprefix(strip_tags($Knack_AssetList->records[$i]->field_19))
             ->setAssetnumber(strip_tags($Knack_AssetList->records[$i]->field_20))
             ->setAssetname(strip_tags($Knack_AssetList->records[$i]->field_114))
             ->setCreatedate(new \DateTime(implode("-", array_reverse(explode("/",$Knack_AssetList->records[$i]->field_21)))))
             ->setAssetdescription(strip_tags($Knack_AssetList->records[$i]->field_43))
             ->setAssetowner(strip_tags($Knack_AssetList->records[$i]->field_42))
             ->setAssetcustodian(strip_tags($Knack_AssetList->records[$i]->field_23))
             ->setAssetcriticality(strip_tags($Knack_AssetList->records[$i]->field_38))
             ->setAssetcategory(strip_tags($Knack_AssetList->records[$i]->field_25))
             ->setContainertype(strip_tags($Knack_AssetList->records[$i]->field_26)) 
             ->setAssetcontainername(strip_tags($Knack_AssetList->records[$i]->field_27))
             ->setContainerstreet1(strip_tags($Knack_AssetList->records[$i]->field_28_raw->street))
             ->setContainerstreet2(strip_tags($Knack_AssetList->records[$i]->field_28_raw->street2))
             ->setContainercity(strip_tags($Knack_AssetList->records[$i]->field_28_raw->city))
             ->setContainerstate(strip_tags($Knack_AssetList->records[$i]->field_28_raw->state))
             ->setContainerpostcode(strip_tags($Knack_AssetList->records[$i]->field_28_raw->zip))  
             ->setContainercriticality(strip_tags($Knack_AssetList->records[$i]->field_29))
             ->setIncidenthistory(strip_tags($Knack_AssetList->records[$i]->field_47))
             ->setRequiresbackup(strip_tags($Knack_AssetList->records[$i]->field_50))
             ->setIsbackedup(strip_tags($Knack_AssetList->records[$i]->field_51)) 
             ->setCommercialsla(strip_tags($Knack_AssetList->records[$i]->field_52))
             ->setConfidentiality(strip_tags($Knack_AssetList->records[$i]->field_53))  
             ->setConfidentialitynotes(strip_tags($Knack_AssetList->records[$i]->field_54)) 
             ->setIntegrity(strip_tags($Knack_AssetList->records[$i]->field_55)) 
             ->setIntegritynotes(strip_tags($Knack_AssetList->records[$i]->field_56))
             ->setAvailability(strip_tags($Knack_AssetList->records[$i]->field_57)) 
             ->setAvailabilitynotes(strip_tags($Knack_AssetList->records[$i]->field_58))
             ->setAssetvalue(preg_replace('/[\$,]/', '',strip_tags($Knack_AssetList->records[$i]->field_59)))
             ->setAssetvaluelevel(strip_tags($Knack_AssetList->records[$i]->field_60))
             ->setRiskvulnerability(strip_tags($Knack_AssetList->records[$i]->field_61)) 
             ->setRiskcompliance(strip_tags($Knack_AssetList->records[$i]->field_62)) 
             ->setRisklikelihood(strip_tags($Knack_AssetList->records[$i]->field_64))
             ->setAssetretentionperiod(strip_tags($Knack_AssetList->records[$i]->field_151))
             ->setAssetreviewdate(new \DateTime(implode("-", array_reverse(explode("/",$Knack_AssetList->records[$i]->field_152)))))
             ->setProfilecreator(strip_tags($Knack_AssetList->records[$i]->field_153))
             ->setCustomerprofile(strip_tags($Knack_AssetList->records[$i]->field_159))
             ->setActivestatus(strip_tags($Knack_AssetList->records[$i]->field_182))
             ->setRiskthreattype(strip_tags($Knack_AssetList->records[$i]->field_187));

       /* Add Multiple relationship columns */
         if(isset($Knack_AssetList->records[$i]->field_24_raw) and count($Knack_AssetList->records[$i]->field_24_raw)>1){       
         foreach($Knack_AssetList->records[$i]->field_24_raw as $fc){
            $functionalarea=$assetservice->FindObjectById('FunctionalArea', $fc->id); 
            $asset->addFunctionalArea($functionalarea);
         }
         }
         
         if(isset($Knack_AssetList->records[$i]->field_46_raw) and count($Knack_AssetList->records[$i]->field_46_raw)>1){         
         foreach($Knack_AssetList->records[$i]->field_46_raw as $ac){
            $assetcontrol=$assetservice->FindObjectById('AssetControl', $ac->id); 
            $asset->addAssetcontrol($assetcontrol);
         }
         }
         
         if(isset($Knack_AssetList->records[$i]->field_48_raw) and count($Knack_AssetList->records[$i]->field_48_raw)>1){         
         foreach($Knack_AssetList->records[$i]->field_48_raw as $cp){
            $compliance=$assetservice->FindObjectById('Compliance', $cp->id); 
            $asset->addCompliance($compliance);
         }
         }
         
         if(isset($Knack_AssetList->records[$i]->field_167_raw) and count($Knack_AssetList->records[$i]->field_167_raw)>1){         
         foreach($Knack_AssetList->records[$i]->field_167_raw as $ca){
            $controlsapplied=$assetservice->FindObjectById('ControlsApplied', $ca->id); 
            $asset->addControlsapplied($controlsapplied);
         }
         }
         
         if(isset($Knack_AssetList->records[$i]->field_166_raw) and count($Knack_AssetList->records[$i]->field_166_raw)>1){
         foreach($Knack_AssetList->records[$i]->field_166_raw as $et){
            $externalthreat=$assetservice->FindObjectById('ExternalThreat', $et->id); 
            $asset->addExternalthreat($externalthreat);
         }
         }
         if(isset($Knack_AssetList->records[$i]->field_165_raw) and count($Knack_AssetList->records[$i]->field_165_raw)>1){
         foreach($Knack_AssetList->records[$i]->field_165_raw as $it){
            $internalthreat=$assetservice->FindObjectById('InternalThreat', $it->id); 
            $asset->addInternalthreat($internalthreat);
         }
         }
        if(isset($Knack_AssetList->records[$i]->field_164_raw) and count($Knack_AssetList->records[$i]->field_164_raw)>1){ 
         foreach($Knack_AssetList->records[$i]->field_164_raw as $rs){
            $risksource=$assetservice->FindObjectById('RiskSource', $rs->id); 
            $asset->addRisksource($risksource);
         }  
         }
          array_push($this->assetlist, $asset);
       }
       $assetservice->SaveAsset($this->assetlist);        
  
       return $this->render('iSecureBundle:Asset:save.html.twig');
    }
}
