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
 * @ORM\Table(name="externalthreat")
 */
class ExternalThreat{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $externalthreatname=null;
    
    /**
     * @ORM\ManyToMany(targetEntity="Asset", mappedBy="externalthreats")
     */    
    protected $assets;
    
    public function __construct() {
        $this->assets=new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function addAsset(Asset $asset){
        $this->assets[]=$asset;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getExternalthreatname() {
        return $this->externalthreatname;
    }

    public function getAssets() {
        return $this->assets;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setExternalthreatname($externalthreatname) {
        $this->externalthreatname = $externalthreatname;
    }

    public function setAssets($assets) {
        $this->assets = $assets;
    }



    /**
     * Remove assets
     *
     * @param \Sentric\iSecureBundle\Entity\Asset $assets
     */
    public function removeAsset(\Sentric\iSecureBundle\Entity\Asset $assets)
    {
        $this->assets->removeElement($assets);
    }
}
