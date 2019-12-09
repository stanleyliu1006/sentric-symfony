<?php

namespace Sentric\ContractManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $questionname;

    
    /**
     * @ORM\OneToMany(targetEntity="Checklist", mappedBy="question")
     */

    protected $checklists;
    
    /**
     * @ORM\ManyToOne(targetEntity="QuestionTitle", inversedBy="question")
     * @ORM\JoinColumn(name="questiontitle_id", referencedColumnName="id")
     */
    protected $questiontitle;
    
    public function __construct() {
        $this->checklists = new \Doctrine\Common\Collections\ArrayCollection();
    }  
    
    public function getId() {
        return $this->id;
    }

    public function getQuestionname() {
        return $this->questionname;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setQuestionname($questionname) {
        $this->questionname = $questionname;
        return $this;
    }


    public function getChecklists() {
        return $this->checklists;
    }

    public function getQuestiontitle() {
        return $this->questiontitle;
    }

    public function setChecklists($checklists) {
        $this->checklists = $checklists;
        return $this;
    }

    public function setQuestiontitle($questiontitle) {
        $this->questiontitle = $questiontitle;
        return $this;
    }




}
