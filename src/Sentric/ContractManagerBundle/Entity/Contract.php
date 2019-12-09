<?php

namespace Sentric\ContractManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contract")
 */
class Contract{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $contractname;
    
    /**
     * @ORM\OneToMany(targetEntity="Checklist", mappedBy="contract")
     */

    protected $checklists;
    
    /**
     * @ORM\ManyToMany(targetEntity="ChecklistCategory", inversedBy="contract")
     */       
    protected $checklistcategories;     
    
    public function __construct() {
        $this->checklists = new \Doctrine\Common\Collections\ArrayCollection();
        $this->checklistcategories = new \Doctrine\Common\Collections\ArrayCollection();
    }    
    
    public function getId() {
        return $this->id;
    }

    public function getContractname() {
        return $this->contractname;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setContractname($contractname) {
        $this->contractname = $contractname;
           return $this;
    }
    public function getChecklists() {
        return $this->checklists;
    }

    public function getChecklistcategories() {
        return $this->checklistcategories;
    }

    public function setChecklists($checklists) {
        $this->checklists = $checklists;
        return $this;
    }

    public function setChecklistcategories($checklistcategories) {
        $this->checklistcategories = $checklistcategories;
        return $this;
    }

    /**
     * Add checklistcategories
     *
     * @param \Sentric\ContractManagerBundle\Entity\ChecklistCategory $checklistcategories
     * @return Contract
     */
    public function addChecklistCategory(\Sentric\ContractManagerBundle\Entity\ChecklistCategory $checklistcategories)
    {   $checklistcategories->addContract($this);
        $this->checklistcategories[] = $checklistcategories;
        return $this;
    }

}
