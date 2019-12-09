<?php

namespace Sentric\ContractManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=80)
     */
    protected $answer;

    /**
     * @ORM\OneToMany(targetEntity="Checklist", mappedBy="answer")
     */

    protected $checklists;

    public function __construct() {
        $this->checklists = new \Doctrine\Common\Collections\ArrayCollection();
    } 
    
    public function getId() {
        return $this->id;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
        return $this;
    }





}
