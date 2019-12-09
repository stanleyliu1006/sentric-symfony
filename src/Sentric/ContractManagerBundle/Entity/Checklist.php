<?php

namespace Sentric\ContractManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="checklist")
 */
class Checklist{
    
    /**
     * @ORM\Column(type="string", length=80)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Contract", inversedBy="checklist")
     * @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     */
    protected $contract;
    
    /**
     * @ORM\ManyToOne(targetEntity="QuestionTitle", inversedBy="checklist")
     * @ORM\JoinColumn(name="questiontitle_id", referencedColumnName="id")
     */
    protected $questiontitle;
    
      /**
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="checklist")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    protected $question;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Answer", inversedBy="checklist")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     */
    protected $answer;       
    
    /**
     * @ORM\ManyToOne(targetEntity="ChecklistCategory", inversedBy="checklist")
     * @ORM\JoinColumn(name="checklistcategory_id", referencedColumnName="id")
     */
    protected $checklistcategory;  
    
    public function __construct() {

    }  
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getContract() {
        return $this->contract;
    }

    public function getQuestiontitle() {
        return $this->questiontitle;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function getChecklistcategory() {
        return $this->checklistcategory;
    }

    public function setContract($contract) {
        $this->contract = $contract;
        return $this;
    }

    public function setQuestiontitle($questiontitle) {
        $this->questiontitle = $questiontitle;
        return $this;
    }

    public function setQuestion($question) {
        $this->question = $question;
        return $this;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
        return $this;
    }

    public function setChecklistcategory($checklistcategory) {
        $this->checklistcategory = $checklistcategory;
        return $this;
    }




}
