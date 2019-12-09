<?php

namespace Sentric\ContractManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="questiontitle")
 */
class QuestionTitle
{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $questiontitlename;
    
    /**
     * @ORM\OneToMany(targetEntity="Checklist", mappedBy="questiontitle")
     */

    protected $checklists;
    
    /**
     * @ORM\OneToMany(targetEntity="Question", mappedBy="questiontitle")
     */

    protected $questions;

    /**
     * @ORM\ManyToOne(targetEntity="ChecklistCategory", inversedBy="questiontitle")
     * @ORM\JoinColumn(name="checklistcategory_id", referencedColumnName="id")
     */
    protected $checklistcategory;
    
    public function __construct() {
        $this->checklists = new \Doctrine\Common\Collections\ArrayCollection();
        $this->questions = new \Doctrine\Common\Collections\ArrayCollection();
    }  
    
    public function getId() {
        return $this->id;
    }


    public function getChecklists() {
        return $this->checklists;
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function getChecklistcategory() {
        return $this->checklistcategory;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getQuestiontitlename() {
        return $this->questiontitlename;
    }

    public function setQuestiontitlename($questiontitlename) {
        $this->questiontitlename = $questiontitlename;
        return $this;
    }

    
    public function setChecklists($checklists) {
        $this->checklists = $checklists;
         return $this;
    }

    public function setQuestions($questions) {
        $this->questions = $questions;
         return $this;
    }

    public function setChecklistcategory($checklistcategory) {
        $this->checklistcategory = $checklistcategory;
         return $this;
    }






}
