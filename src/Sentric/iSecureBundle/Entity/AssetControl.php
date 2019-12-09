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
 * @ORM\Table(name="assetcontrol")
 */
class AssetControl{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */    
    protected $assetcontrolname=null;
    
    /**
     * @ORM\ManyToMany(targetEntity="Asset", mappedBy="assetcontrols")
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

    public function getAssetcontrolname() {
        return $this->assetcontrolname;
    }

    public function getAssets() {
        return $this->assets;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setAssetcontrolname($assetcontrolname) {
        $this->assetcontrolname = $assetcontrolname;
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
