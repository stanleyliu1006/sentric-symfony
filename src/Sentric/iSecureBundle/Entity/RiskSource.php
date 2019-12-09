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
 * @ORM\Table(name="risksource")
 */
class RiskSource{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $risksourcename=null;
    
    /**
     * @ORM\ManyToMany(targetEntity="Asset", mappedBy="risksources")
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

    public function getRisksourcename() {
        return $this->risksourcename;
    }

    public function getAssets() {
        return $this->assets;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRisksourcename($risksourcename) {
        $this->risksourcename = $risksourcename;
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
