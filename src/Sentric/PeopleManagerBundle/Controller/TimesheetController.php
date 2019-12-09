<?php

namespace Sentric\PeopleManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TimesheetController extends Controller
{
    
        public function createbatchAction()
    {   
            /*
             * Retrieve the Job object fields and construct 
             * the post data into timesheet object
             */
        $knacktimesheetservice = $this->get('knacktimesheetservice'); 
        $Knack_JobList=$knacktimesheetservice ->GetActiveJobs();

        if($Knack_JobList->total_records>0){
        for ($i=0; $i<$Knack_JobList->total_records; $i++) {
            //Initial Allocation Values
            $assignpl="";
            $ptoffice="";
            $company="";
            $approver="";
            $employee="";
            //Assigned to P&L field
            foreach($Knack_JobList->records[$i]->field_134_raw as $jb){$assignpl=$jb->id; } 
            //Project office field
            foreach($Knack_JobList->records[$i]->field_135_raw as $jb){$ptoffice=$jb->id; } 
            //Candidate company field
            foreach($Knack_JobList->records[$i]->field_130_raw as $jb){$company=$jb->id; } 
            //Approver field
            foreach($Knack_JobList->records[$i]->field_146_raw as $jb){$approver=$jb->id; } 
            //Employee field
            foreach($Knack_JobList->records[$i]->field_143_raw as $jb){$employee=$jb->id; } 
            
            $joblist_new["field_5"] =date('m/d/Y', strtotime('next friday'));
            $joblist_new["field_17"]="55a4b383cb42cb155ddbb3b8";
            $joblist_new["field_117"] = $assignpl; 
            $joblist_new["field_118"] = $ptoffice;
            $joblist_new["field_63"] = $company;
            $joblist_new["field_70"] = $approver;
            $joblist_new["field_15"] = $employee;
            
            $postdata = json_encode($joblist_new);
            $knacktimesheetservice ->KnackAPIPostAdd("object_5", $postdata);
            
        }    
            
        }
        //print_r($knacktimesheetservice ->GetStatus());
        return $this->render('PeopleManagerBundle:Timesheet:createbatch.html.twig');
    }
}
