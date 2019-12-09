<?php

namespace Sentric\ContractManagerBundle\Service;

use Doctrine\ORM\EntityManager;

class ChecklistService {

    protected $em;
    protected $con;

    public function __construct(\Doctrine\ORM\EntityManager $em) {
        $this->em = $em;
    }

    /* Find object function by ID */

    public function FindObjectById($object, $id) {
        $object = $this->em->getRepository('ContractManagerBundle:' . $object)->find($id);
        if (!$object) {
            throw $this->createNotFoundException(
                    'No object found for id ' . $id
            );
        } else {
            return $object;
        }
    }

    public function TruncateAllData($tableNames, $cascade = false) {
        /* Delete All checklist tables records */
        $this->em->createQuery('DELETE FROM ContractManagerBundle:Checklist')->execute();
        $this->em->createQuery('DELETE FROM ContractManagerBundle:Contract')->execute();
        $this->em->createQuery('DELETE FROM ContractManagerBundle:Question')->execute();
        $this->em->createQuery('DELETE FROM ContractManagerBundle:QuestionTitle')->execute();
        $this->em->createQuery('DELETE FROM ContractManagerBundle:Answer')->execute();
        $this->em->createQuery('DELETE FROM ContractManagerBundle:ChecklistCategory')->execute();

        /* Truncate All Tables */
        $connection = $this->em->getConnection();
        $platform = $connection->getDatabasePlatform();
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 0;');
        foreach ($tableNames as $name) {
            $connection->executeUpdate($platform->getTruncateTableSQL($name, $cascade));
        }
        $connection->executeQuery('SET FOREIGN_KEY_CHECKS = 1;');
    }

    public function SaveChecklist($checklistlist) {
        foreach ($checklistlist as $cl) {
            $this->em->persist($cl);
        }
        $this->em->flush();
    }

    public function SaveContract($contractlist) {
        foreach ($contractlist as $co) {
            $this->em->persist($co);
        }
        $this->em->flush();
    }

    public function SaveQuestionTitle($titlelist) {
        foreach ($titlelist as $ti) {
            $this->em->persist($ti);
        }
        $this->em->flush();
    }

    public function SaveQuestion($questionlist) {
        foreach ($questionlist as $qu) {
            $this->em->persist($qu);
        }
        $this->em->flush();
    }

    public function SaveAnswer($answerlist) {
        foreach ($answerlist as $an) {
            $this->em->persist($an);
        }
        $this->em->flush();
    }

    public function SaveChecklistCategory($checklistcategorylist) {
        foreach ($checklistcategorylist as $cl) {
            $this->em->persist($cl);
        }
        $this->em->flush();
    }

    public function FindContractbyId($id) {
        return $this->em->getRepository('ContractManagerBundle:Contract')->find($id);
    }

    public function FindQuestionTitlebyId($id) {
        return $this->em->getRepository('ContractManagerBundle:QuestionTitle')->find($id);
    }

    public function FindQuestionbyId($id) {
        return $this->em->getRepository('ContractManagerBundle:Question')->find($id);
    }

    public function FindAnswerbyId($id) {
        return $this->em->getRepository('ContractManagerBundle:Answer')->find($id);
    }

    public function FindChecklistCategorybyId($id) {
        return $this->em->getRepository('ContractManagerBundle:ChecklistCategory')->find($id);
    }

    public function FindAllContractsId() {
        $query = $this->em->createQuery('select con.id from ContractManagerBundle:Contract con');
        $contractsid = $query->getResult();
        return $contractsid;
    }
    public function FindAllContracts() {
       return $this->em->getRepository('ContractManagerBundle:Contract')->findAll();
    }

    public function FindAllQuestionTitleChecklistCategoryId($contractid) {
        $conn = $this->em->getConnection();
        $sql = 'SELECT qe.`id` as question_id, qe.`questiontitle_id` as questiontitle_id,  qet.`checklistcategory_id` as checklistcategory_id FROM `question` AS qe INNER JOIN `questiontitle` AS qet ON qe.`questiontitle_id`=qet.`id`
                INNER JOIN `checklistcategory` AS chc ON chc.`id`=qet.`checklistcategory_id`
                INNER JOIN `contract_checklistcategory` AS conc ON conc.`checklistcategory_id`=chc.`id`
                WHERE conc.`contract_id` = :contractid';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam("contractid", $contractid);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function in_array_r($item, $array) {
        return preg_match('/"' . $item . '"/i', json_encode($array));
    }

}
