<?php

namespace Sentric\ContractManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ChecklistController extends Controller
{
    protected $contractlist;
    
    protected $questiontitlelist;
    
    protected $questionlist;
    
    protected $answerlist;
    
    protected $checklistlist;

    protected $checklistcategorylist;
    
    public function saveAction()
    {   
       /* Initial the List value */ 
        $this->contractlist= array();
        $this->questiontitlelist= array();
        $this->questionlist= array();
        $this->answerlist= array();
        $this->checklistlist= array();
        $this->checklistcategorylist=array();
        
       /* Check if contract record exist in contract tables,
        * if not then populate standard checklist with the new contract back 
        * to knack database (post), to be finished tomorrow */
        $knackchecklistservice = $this->get('knackchecklistservice'); 
        $checklistservice = $this->get('checklistservice');
        $Knack_ContractList=$knackchecklistservice ->GetContract();
        $OrgContractsIdList=$checklistservice->FindAllContractsId();
        
        /* Check if contract record exist in contract tables, but the checklistcategory
         * has been updated, we also need find those contract, and remove their checklist
         * records in Knack database, and overwrite with new checklist category and question.
         */
//        $OrgContractsList=$checklistservice->FindAllContracts();
//
//        for ($i=0; $i<$Knack_ContractList->total_records; $i++) {
//           foreach($OrgContractsList as $contract){
//               if($contract->getId()==$Knack_ContractList->records[$i]->id){
//                   $OrgChecklist=$contract->getChecklistcategories();
//                   $OrgChecklistIdList= array();
//                   foreach($OrgChecklist as $checklist){
//                       $OrgChecklistIdList[] =$checklist->getId();
//                   }
//                  foreach($Knack_ContractList->records[$i]->field_331_raw as $cc){
//                  if(!in_array($cc->id,$OrgChecklistIdList)){
//                      echo "checklist updated";
//                  } 
//                  }
//                  //      print_r($Knack_ContractList->records[$i]);
//                  // print_r($OrgChecklistIdList);
//               }
//           }
//      
//        }
        

       /* Truncate all checklist tables */
        $tablelist= array('answer','checklist','contract','question','questiontitle', 'checklistcategory','contract_checklistcategory');
        $checklistservice->TruncateAllData($tablelist);

       /* Populate the configuration into tables*/
       /* ChecklistCategory Configuration */ 
       $Knack_ChecklistCategoryList=$knackchecklistservice->GetCheckListCategory();
       if($Knack_ChecklistCategoryList->total_records>0){
       for ($i=0; $i<$Knack_ChecklistCategoryList->total_records; $i++) { 
       $ChecklistCategory=new \Sentric\ContractManagerBundle\Entity\ChecklistCategory();
       $ChecklistCategory->setId($Knack_ChecklistCategoryList->records[$i]->id);
       $ChecklistCategory->setChecklistcategoryname($Knack_ChecklistCategoryList->records[$i]->field_322);
       array_push($this->checklistcategorylist, $ChecklistCategory);
       }        
       $checklistservice->SaveChecklistCategory($this->checklistcategorylist);
       }
       /* Contract Configuration */ 
       if($Knack_ContractList->total_records>0){
       for ($i=0; $i<$Knack_ContractList->total_records; $i++) {
       $contract=new \Sentric\ContractManagerBundle\Entity\Contract();
       $contract->setId($Knack_ContractList->records[$i]->id);
       $contract->setContractname($Knack_ContractList->records[$i]->field_275);
       /* Add Multiple relationship columns */
         foreach($Knack_ContractList->records[$i]->field_331_raw as $cc){
            $checklistcategory=$checklistservice->FindObjectById('ChecklistCategory',$cc->id); 
            $contract->addChecklistCategory($checklistcategory);
         }
       array_push($this->contractlist, $contract);
       }
       $checklistservice->SaveContract($this->contractlist);
       }
      /* QuestionTitle Configuration */ 
       $Knack_QuestionTitleList=$knackchecklistservice->GetQuestionTitle();
       if($Knack_QuestionTitleList->total_records>0){
       for ($i=0; $i<$Knack_QuestionTitleList->total_records; $i++) { 
       $title=new \Sentric\ContractManagerBundle\Entity\QuestionTitle();
       $title->setId($Knack_QuestionTitleList->records[$i]->id);
       $title->setQuestiontitlename($Knack_QuestionTitleList->records[$i]->field_279);
       $checklistcategory= $checklistservice->FindChecklistCategorybyId($Knack_QuestionTitleList->records[$i]->field_330_raw[0]->id);
       $title->setChecklistcategory($checklistcategory);
       array_push($this->questiontitlelist, $title);
       }

      $checklistservice->SaveQuestionTitle($this->questiontitlelist);
       }
       /* Question Configuration */  
       $Knack_QuestionList=$knackchecklistservice->GetQuestion();
       if($Knack_QuestionList->total_records>0){
       for($j=$Knack_QuestionList->total_pages; $j>0; $j--){ 
       $Knack_QuestionListPerPage=$knackchecklistservice->GetQuestionWithPage($j);
       for ($i=0; $i<count($Knack_QuestionListPerPage->records); $i++) {
       $question=new \Sentric\ContractManagerBundle\Entity\Question();
       $question->setId($Knack_QuestionListPerPage->records[$i]->id);
       $question->setQuestionname($Knack_QuestionListPerPage->records[$i]->field_276);
       $questiontitle=$checklistservice->FindQuestionTitlebyId($Knack_QuestionListPerPage->records[$i]->field_280_raw[0]->id);
       $question->setQuestiontitle($questiontitle);
       array_push($this->questionlist, $question);
       }
       }
       $checklistservice->SaveQuestion($this->questionlist);           
       }
       /* Answer Configuration */
       $Knack_AnswerList=$knackchecklistservice->GetAnswer();
       if($Knack_AnswerList->total_records>0){
       for ($i=0; $i<$Knack_AnswerList->total_records; $i++) {
       $answer=new \Sentric\ContractManagerBundle\Entity\Answer();
       $answer->setId($Knack_AnswerList->records[$i]->id);
       $answer->setAnswer($Knack_AnswerList->records[$i]->field_278);
       array_push($this->answerlist, $answer);
       }
       $checklistservice->SaveAnswer($this->answerlist);   
    }
       /* add new post data into checklist object */
       for ($i=0; $i<$Knack_ContractList->total_records; $i++) {
           if(!$checklistservice->in_array_r($Knack_ContractList->records[$i]->id, $OrgContractsIdList)){
              $ChecklistArray=$checklistservice->FindAllQuestionTitleChecklistCategoryId($Knack_ContractList->records[$i]->id); 
              foreach($ChecklistArray as $ca){
              $checklist_new["field_323"] = $Knack_ContractList->records[$i]->id;
              $checklist_new["field_325"] = $ca['checklistcategory_id'];
              $checklist_new["field_326"] = $ca['questiontitle_id'];
              $checklist_new["field_327"] = $ca['question_id'];
              $postdata = json_encode($checklist_new);
              $knackchecklistservice ->KnackAPIPostAdd("object_47", $postdata);
              }
           }
 }

       //$checklistservice->SaveChecklist($this->checklistlist);    
       return $this->render('ContractManagerBundle:Checklist:save.html.twig');
    }
}
