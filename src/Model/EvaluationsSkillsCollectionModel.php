<?php

namespace App\Model;

class EvaluationsSkillsCollectionModel
{
    private array $evaluationsSkills = [];

    public  function __construct(){

    }

    /**
     * @return array
     */
    public function getEvaluationsSkills(): array
    {
        return $this->evaluationsSkills;
    }

    /**
     * @param array $evaluationsSkills
     */
    public function setEvaluationsSkills(array $evaluationsSkills): void
    {
        $this->evaluationsSkills = $evaluationsSkills;
    }
}