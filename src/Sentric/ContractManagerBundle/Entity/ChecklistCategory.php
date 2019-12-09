<?php

namespace Sentric\ContractManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="checklistcategory")
 */
class ChecklistCategory
{
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $checklistcategoryname;
    
    /**
     * @ORM\OneToMany(targetEntity="Checklist", mappedBy="checklistcategory")
     */

    protected $checklists;
    
    /**
     * @ORM\OneToMany(targetEntity="QuestionTitle", mappedBy="checklistcategory")
     */

    protected $questiontitles;
    
    /**
     * @ORM\ManyToMany(targetEntity="Contract", mappedBy="checklistcategory")
     */    
    protected $contracts;
    
    public function __construct() {
        $this->checklists = new \Doctrine\Common\Collections\ArrayCollection();
        $this->questiontitles = new \Doctrine\Common\Collections\ArrayCollection();
         $this->contracts = new \Doctrine\Common\Collections\ArrayCollection();
    }   
    
    public function getId() {
        return $this->id;
    }

    public function getChecklistcategoryname() {
        return $this->checklistcategoryname;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setChecklistcategoryname($checklistcategoryname) {
        $this->checklistcategoryname = $checklistcategoryname;
        return $this;
    }
    public function getChecklists() {
        return $this->checklists;
    }

    public function getQuestiontitles() {
        return $this->questiontitles;
    }

    public function setChecklists($checklists) {
        $this->checklists = $checklists;
        return $this;
    }

    public function setQuestiontitles($questiontitles) {
        $this->questiontitles = $questiontitles;
        return $this;
    }
    public function getContracts() {
        return $this->contracts;
    }

    public function setContracts($contracts) {
        $this->contracts = $contracts;
        return $this;
    }
    
  public function addContract(Contract $contract){
        $this->contracts[]=$contract;
    }



}
