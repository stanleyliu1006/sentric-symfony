<?php

namespace Sentric\iSecureBundle\Service;
use Doctrine\ORM\EntityManager;

class AssetService
{
    protected $em;
    
  public function __construct(\Doctrine\ORM\EntityManager $em)
  {
    $this->em = $em;
  }
    
   /* Find object function by ID */
    public function FindObjectById($object, $id){
       $object = $this->em->getRepository('iSecureBundle:'.$object)->find($id);
         if (!$object) {
        throw $this->createNotFoundException(
            'No object found for id '.$id
        );
    }
    else{
        return $object;
    }
  }
    
    public function TruncateAllData($tableNames, $cascade=false){
    /* Delete Asset table records */    
    $this->em->createQuery('DELETE FROM iSecureBundle:Asset')->execute();    
    /* Truncate All Tables */
    $connection = $this->em->getConnection();
    $platform = $connection->getDatabasePlatform();
    $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
    foreach ($tableNames as $name) {
        $connection->executeUpdate($platform->getTruncateTableSQL($name,$cascade));
    }
    $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
 }
    
    public function SaveFunctionalArea($functionalarealist){
        foreach ($functionalarealist as $fa){
            $this->em->persist($fa);
        }
        $this->em->flush();
    }
    
    public function SaveAssetControl($assetcontrollist){
         foreach ($assetcontrollist as $ac){
            $this->em->persist($ac);
        }
        $this->em->flush();
    }
    
    public function SaveCompliance($compliancelist){
        foreach ($compliancelist as $cp){
            $this->em->persist($cp);
        }
        $this->em->flush();
    }
    
    public function SaveControlsapplied($controlsappliedlist){
        foreach ($controlsappliedlist as $ca){
            $this->em->persist($ca);
        }
        $this->em->flush();
    }
    
    public function SaveExternalThreat($externalthreatlist){
        foreach ($externalthreatlist as $et){
            $this->em->persist($et);
        }
        $this->em->flush();        
    }
    
    public function SaveInternalThreat($internalthreatlist){
        foreach ($internalthreatlist as $it){
            $this->em->persist($it);
        }
        $this->em->flush();  
    }
    
    public function SaveRiskSource($risksourcelist){
        foreach ($risksourcelist as $rs){
            $this->em->persist($rs);
        }
        $this->em->flush();  
    }
    
    public function SaveAsset($assetlist){
        foreach ($assetlist as $as){
            $this->em->persist($as);
        }
        $this->em->flush();
        $this->em->clear();
    }
    
    
}

