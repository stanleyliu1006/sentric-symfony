<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sentric\iSecureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="asset")
 */
class Asset{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=4)
     */
    protected $assetnumberprefix;
    
    /**
     * @ORM\Column(type="integer", length=4)
     */
    protected $assetnumber;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetname=null;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */    
    protected $createdate=null;
    
    /**
     * @ORM\Column(type="text", nullable=true, length=65535)
     */    
    protected $assetdescription=null;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetowner=null;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetcustodian=null;
    
    /**
     * @ORM\ManyToMany(targetEntity="FunctionalArea", inversedBy="assets")
     */    
    protected $functionalareas;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetcriticality=null;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetcategory=null;  
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $containertype=null;   

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetcontainername=null;   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */    
    protected $containerstreet1=null;   

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */    
    protected $containerstreet2=null;   

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $containercity=null;   

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $containerstate=null; 

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */    
    protected $containerpostcode=null; 
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $containercriticality=null; 
    
    /**
     * @ORM\ManyToMany(targetEntity="AssetControl", inversedBy="assets")
     */    
    protected $assetcontrols;

    /**
     * @ORM\Column(type="text", nullable=true, length=65535)
     */    
    protected $incidenthistory=null; 
    
    /**
     * @ORM\ManyToMany(targetEntity="Compliance", inversedBy="assets")
     */    
    protected $compliance; 
    
    /**
     * @ORM\ManyToMany(targetEntity="ControlsApplied", inversedBy="assets")
     */   
    protected $controlsapplied; 
    
    /**
     * @ORM\Column(type="string", length=5, nullable=true, options={"fixed" = true})
     */    
    protected $requiresbackup=null; 
 
    /**
     * @ORM\Column(type="string", length=5, nullable=true, options={"fixed" = true})
     */    
    protected $isbackedup=null; 
    
    /**
     * @ORM\Column(type="string", length=5, nullable=true, options={"fixed" = true})
     */    
    protected $commercialsla=null; 

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $confidentiality=null; 
    
    /**
     * @ORM\Column(type="text", nullable=true, length=65535)
     */    
    protected $confidentialitynotes=null; 
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $integrity=null; 
    
    /**
     * @ORM\Column(type="text", nullable=true, length=65535)
     */    
    protected $integritynotes=null; 
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $availability=null; 
    
    /**
     * @ORM\Column(type="text", nullable=true, length=65535)
     */    
    protected $availabilitynotes=null; 
    
    /**
     * @ORM\Column(type="float", nullable=true)
     */    
    protected $assetvalue=0.00; 
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetvaluelevel=null; 
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $riskvulnerability=null; 
    
     /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $riskcompliance=null;
    
    /**
     * @ORM\ManyToMany(targetEntity="RiskSource", inversedBy="assets")
     */    
    protected $risksource;    

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $risklikelihood=null;
    
    /**
     * @ORM\ManyToMany(targetEntity="InternalThreat", inversedBy="assets")
     */    
    protected $internalthreat; 
    
    /**
     * @ORM\ManyToMany(targetEntity="ExternalThreat", inversedBy="assets")
     */    
    protected $externalthreat;  
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */    
    protected $assetretentionperiod=null;    
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */    
    protected $assetreviewdate=null;    
    
    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */    
    protected $profilecreator=null; 
    
    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */    
    protected $customerprofile=null;    
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $activestatus=null;  
    
       /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $riskthreattype=null; 
    
    public function __construct() {
        $this->functionalareas=new \Doctrine\Common\Collections\ArrayCollection();
        $this->assetcontrols=new \Doctrine\Common\Collections\ArrayCollection();
        $this->compliance=new \Doctrine\Common\Collections\ArrayCollection();
        $this->controlsapplied=new \Doctrine\Common\Collections\ArrayCollection();
        $this->risksource=new \Doctrine\Common\Collections\ArrayCollection();
        $this->internalthreat=new \Doctrine\Common\Collections\ArrayCollection();
        $this->externalthreat=new \Doctrine\Common\Collections\ArrayCollection();        
    }    
    
    public function getId() {
        return $this->id;
    }
    public function getAssetnumberprefix() {
        return $this->assetnumberprefix;
    }

    public function getAssetnumber() {
        return $this->assetnumber;
    }
    public function getCreatedate() {
        return $this->createdate;
    }

    public function setCreatedate($createdate) {
        $this->createdate = $createdate;
        return $this;
    }

        public function getAssetname() {
        return $this->assetname;
    }

    public function setAssetnumberprefix($assetnumberprefix) {
        $this->assetnumberprefix = $assetnumberprefix;
        return $this;
    }

    public function setAssetnumber($assetnumber) {
        $this->assetnumber = $assetnumber;
        return $this;
    }

    public function setAssetname($assetname) {
        $this->assetname = $assetname;
        return $this;
    }

    public function getAssetdescription() {
        return $this->assetdescription;
    }

    public function getAssetowner() {
        return $this->assetowner;
    }

    public function getAssetcustodian() {
        return $this->assetcustodian;
    }

    public function getFunctionalareas() {
        return $this->functionalareas;
    }

    public function getAssetcriticality() {
        return $this->assetcriticality;
    }

    public function getAssetcategory() {
        return $this->assetcategory;
    }

    public function getContainertype() {
        return $this->containertype;
    }

    public function getAssetcontainername() {
        return $this->assetcontainername;
    }

    public function getContainerstreet1() {
        return $this->containerstreet1;
    }

    public function getContainerstreet2() {
        return $this->containerstreet2;
    }

    public function getContainercity() {
        return $this->containercity;
    }

    public function getContainerstate() {
        return $this->containerstate;
    }

    public function getContainerpostcode() {
        return $this->containerpostcode;
    }

    public function getContainercriticality() {
        return $this->containercriticality;
    }

    public function getAssetcontrols() {
        return $this->assetcontrols;
    }

    public function getIncidenthistory() {
        return $this->incidenthistory;
    }

    public function getCompliance() {
        return $this->compliance;
    }

    public function getControlsapplied() {
        return $this->controlsapplied;
    }

    public function getRequiresbackup() {
        return $this->requiresbackup;
    }

    public function getIsbackedup() {
        return $this->isbackedup;
    }

    public function getCommercialsla() {
        return $this->commercialsla;
    }

    public function getConfidentiality() {
        return $this->confidentiality;
    }

    public function getConfidentialitynotes() {
        return $this->confidentialitynotes;
    }

    public function getIntegrity() {
        return $this->integrity;
    }

    public function getIntegritynotes() {
        return $this->integritynotes;
    }

    public function getAvailability() {
        return $this->availability;
    }

    public function getAvailabilitynotes() {
        return $this->availabilitynotes;
    }

    public function getAssetvalue() {
        return $this->assetvalue;
    }

    public function getAssetvaluelevel() {
        return $this->assetvaluelevel;
    }

    public function getRiskvulnerability() {
        return $this->riskvulnerability;
    }

    public function getRiskcompliance() {
        return $this->riskcompliance;
    }

    public function getRisksource() {
        return $this->risksource;
    }

    public function getRisklikelihood() {
        return $this->risklikelihood;
    }

    public function getInternalthreat() {
        return $this->internalthreat;
    }

    public function getExternalthreat() {
        return $this->externalthreat;
    }

    public function getAssetretentionperiod() {
        return $this->assetretentionperiod;
    }

    public function getAssetreviewdate() {
        return $this->assetreviewdate;
    }

    public function getProfilecreator() {
        return $this->profilecreator;
    }

    public function getCustomerprofile() {
        return $this->customerprofile;
    }
    
    public function  setAssetdescription($assetdescription) {
        $this->assetdescription = $assetdescription;
        return $this;
    }
    
    public function  setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setAssetowner($assetowner) {
        $this->assetowner = $assetowner;
        return $this;
    }

    public function setAssetcustodian($assetcustodian) {
        $this->assetcustodian = $assetcustodian;
        return $this;
    }

    public function setFunctionalareas($functionalareas) {
        $this->functionalareas = $functionalareas;
    }

    public function setAssetcriticality($assetcriticality) {
        $this->assetcriticality = $assetcriticality;
        return $this;
    }

    public function setAssetcategory($assetcategory) {
        $this->assetcategory = $assetcategory;
        return $this;
    }

    public function setContainertype($containertype) {
        $this->containertype = $containertype;
        return $this;
    }

    public function setAssetcontainername($assetcontainername) {
        $this->assetcontainername = $assetcontainername;
        return $this;
    }

    public function setContainerstreet1($containerstreet1) {
        $this->containerstreet1 = $containerstreet1;
        return $this;
    }

    public function setContainerstreet2($containerstreet2) {
        $this->containerstreet2 = $containerstreet2;
        return $this;
    }

    public function setContainercity($containercity) {
        $this->containercity = $containercity;
         return $this;
    }

    public function setContainerstate($containerstate) {
        $this->containerstate = $containerstate;
         return $this;
    }

    public function setContainerpostcode($containerpostcode) {
        $this->containerpostcode = $containerpostcode;
         return $this;
    }

    public function setContainercriticality($containercriticality) {
        $this->containercriticality = $containercriticality;
         return $this;
    }

    public function setAssetcontrols($assetcontrols) {
        $this->assetcontrols = $assetcontrols;
    }

    public function setIncidenthistory($incidenthistory) {
        $this->incidenthistory = $incidenthistory;
        return $this;
    }

    public function setCompliance($compliance) {
        $this->compliance = $compliance;
    }

    public function setControlsapplied($controlsapplied) {
        $this->controlsapplied = $controlsapplied;
    }

    public function setRequiresbackup($requiresbackup) {
        $this->requiresbackup = $requiresbackup;
         return $this;
    }

    public function setIsbackedup($isbackedup) {
        $this->isbackedup = $isbackedup;
         return $this;
    }

    public function setCommercialsla($commercialsla) {
        $this->commercialsla = $commercialsla;
         return $this;
    }

    public function setConfidentiality($confidentiality) {
        $this->confidentiality = $confidentiality;
        return $this;
    }

    public function setConfidentialitynotes($confidentialitynotes) {
        $this->confidentialitynotes = $confidentialitynotes;
        return $this;
    }

    public function setIntegrity($integrity) {
        $this->integrity = $integrity;
        return $this;
    }

    public function setIntegritynotes($integritynotes) {
        $this->integritynotes = $integritynotes;
        return $this;
    }

    public function setAvailability($availability) {
        $this->availability = $availability;
        return $this;
    }

    public function setAvailabilitynotes($availabilitynotes) {
        $this->availabilitynotes = $availabilitynotes;
        return $this;
    }

    public function setAssetvalue($assetvalue) {
        $this->assetvalue = $assetvalue;
        return $this;
    }

    public function setAssetvaluelevel($assetvaluelevel) {
        $this->assetvaluelevel = $assetvaluelevel;
        return $this;
    }

    public function setRiskvulnerability($riskvulnerability) {
        $this->riskvulnerability = $riskvulnerability;
        return $this;
    }

    public function setRiskcompliance($riskcompliance) {
        $this->riskcompliance = $riskcompliance;
        return $this;
    }

    public function setRisksource($risksource) {
        $this->risksource = $risksource;
    }

    public function setRisklikelihood($risklikelihood) {
        $this->risklikelihood = $risklikelihood;
        return $this;
    }

    public function setInternalthreat($internalthreat) {
        $this->internalthreat = $internalthreat;
    }

    public function setExternalthreat($externalthreat) {
        $this->externalthreat = $externalthreat;
    }

    public function setAssetretentionperiod($assetretentionperiod) {
        $this->assetretentionperiod = $assetretentionperiod;
        return $this;
    }

    public function setAssetreviewdate($assetreviewdate) {
        $this->assetreviewdate = $assetreviewdate;
        return $this;
    }

    public function setProfilecreator($profilecreator) {
        $this->profilecreator = $profilecreator;
        return $this;
    }

    public function setCustomerprofile($customerprofile) {
        $this->customerprofile = $customerprofile;
        return $this;
    }
    public function getActivestatus() {
        return $this->activestatus;
    }

    public function setActivestatus($activestatus) {
        $this->activestatus = $activestatus;
        return $this;
    }
    public function getRiskthreattype() {
        return $this->riskthreattype;
    }

    public function setRiskthreattype($riskthreattype) {
        $this->riskthreattype = $riskthreattype;
        return $this;
    }

            
    /* Build Many to Many relationship Add functions */
//    public function addFunctionalArea(Functionalarea $functionalarea){
//        $functionalarea->addAsset($this);
//        $this->functionalareas[]=$functionalarea;
//    } 
//   
//    public function addAssetControl(AssetControl $assetcontrol){
//        $assetcontrol->addAsset($this);
//        $this->assetcontrols[]=$assetcontrol;
//    } 
//    
//    public function addCompliance(Compliance $compliance){
//        $compliance->addAsset($this);
//        $this->compliance[]=$compliance;
//    }
//    
//    public function addControlsApplied(ControlsApplied $controlsapplied){
//        $controlsapplied->addAsset($this);
//        $this->controlsapplied[]=$controlsapplied;
//    } 
//    
//    public function addExternalThreat(ExternalThreat $externalthreat){
//        $externalthreat->addAsset($this);
//        $this->externalthreat[]=$externalthreat;
//    }
//
//    public function addInternalThreat(InternalThreat $internalthreat){
//        $internalthreat->addAsset($this);
//        $this->internalthreat[]=$internalthreat;
//    } 
//    
//    public function addRiskSource(RiskSource $risksource){
//        $risksource->addAsset($this);
//        $this->risksource[]=$risksource;
//    }     

    /**
     * Add functionalareas
     *
     * @param \Sentric\iSecureBundle\Entity\FunctionalArea $functionalareas
     * @return Asset
     */
    public function addFunctionalarea(\Sentric\iSecureBundle\Entity\FunctionalArea $functionalareas)
    {   $functionalareas->addAsset($this);
        $this->functionalareas[] = $functionalareas;

        return $this;
    }

    /**
     * Remove functionalareas
     *
     * @param \Sentric\iSecureBundle\Entity\FunctionalArea $functionalareas
     */
    public function removeFunctionalarea(\Sentric\iSecureBundle\Entity\FunctionalArea $functionalareas)
    {
        $this->functionalareas->removeElement($functionalareas);
    }

    /**
     * Add assetcontrols
     *
     * @param \Sentric\iSecureBundle\Entity\AssetControl $assetcontrols
     * @return Asset
     */
    public function addAssetcontrol(\Sentric\iSecureBundle\Entity\AssetControl $assetcontrols)
    {   $assetcontrols->addAsset($this);
        $this->assetcontrols[] = $assetcontrols;

        return $this;
    }

    /**
     * Remove assetcontrols
     *
     * @param \Sentric\iSecureBundle\Entity\AssetControl $assetcontrols
     */
    public function removeAssetcontrol(\Sentric\iSecureBundle\Entity\AssetControl $assetcontrols)
    {
        $this->assetcontrols->removeElement($assetcontrols);
    }
    /**
     * Add compliance
     *
     * @param \Sentric\iSecureBundle\Entity\Compliance $compliance
     * @return Asset
     */
    public function addCompliance(Compliance $compliance){
        $compliance->addAsset($this);
        $this->compliance[]=$compliance;
        return $this;
    }
    /**
     * Remove compliance
     *
     * @param \Sentric\iSecureBundle\Entity\Compliance $compliance
     */
    public function removeCompliance(\Sentric\iSecureBundle\Entity\Compliance $compliance)
    {
        $this->compliance->removeElement($compliance);
    }

    /**
     * Add controlsapplied
     *
     * @param \Sentric\iSecureBundle\Entity\ControlsApplied $controlsapplied
     * @return Asset
     */
    public function addControlsapplied(\Sentric\iSecureBundle\Entity\ControlsApplied $controlsapplied)
    {   $controlsapplied->addAsset($this);
        $this->controlsapplied[] = $controlsapplied;

        return $this;
    }

    /**
     * Remove controlsapplied
     *
     * @param \Sentric\iSecureBundle\Entity\ControlsApplied $controlsapplied
     */
    public function removeControlsapplied(\Sentric\iSecureBundle\Entity\ControlsApplied $controlsapplied)
    {
        $this->controlsapplied->removeElement($controlsapplied);
    }

    /**
     * Add risksource
     *
     * @param \Sentric\iSecureBundle\Entity\RiskSource $risksource
     * @return Asset
     */
    public function addRisksource(\Sentric\iSecureBundle\Entity\RiskSource $risksource)
    {   $risksource->addAsset($this);
        $this->risksource[] = $risksource;

        return $this;
    }

    /**
     * Remove risksource
     *
     * @param \Sentric\iSecureBundle\Entity\RiskSource $risksource
     */
    public function removeRisksource(\Sentric\iSecureBundle\Entity\RiskSource $risksource)
    {
        $this->risksource->removeElement($risksource);
    }

    /**
     * Add internalthreat
     *
     * @param \Sentric\iSecureBundle\Entity\InternalThreat $internalthreat
     * @return Asset
     */
    public function addInternalthreat(\Sentric\iSecureBundle\Entity\InternalThreat $internalthreat)
    {   $internalthreat->addAsset($this);
        $this->internalthreat[] = $internalthreat;

        return $this;
    }

    /**
     * Remove internalthreat
     *
     * @param \Sentric\iSecureBundle\Entity\InternalThreat $internalthreat
     */
    public function removeInternalthreat(\Sentric\iSecureBundle\Entity\InternalThreat $internalthreat)
    {
        $this->internalthreat->removeElement($internalthreat);
    }

    /**
     * Add externalthreat
     *
     * @param \Sentric\iSecureBundle\Entity\ExternalThreat $externalthreat
     * @return Asset
     */
    public function addExternalthreat(\Sentric\iSecureBundle\Entity\ExternalThreat $externalthreat)
    {   $externalthreat->addAsset($this);
        $this->externalthreat[] = $externalthreat;

        return $this;
    }

    /**
     * Remove externalthreat
     *
     * @param \Sentric\iSecureBundle\Entity\ExternalThreat $externalthreat
     */
    public function removeExternalthreat(\Sentric\iSecureBundle\Entity\ExternalThreat $externalthreat)
    {
        $this->externalthreat->removeElement($externalthreat);
    }
}
