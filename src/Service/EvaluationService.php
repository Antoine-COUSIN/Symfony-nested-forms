<?php

namespace App\Service;

use App\Entity\EvaluationSkill;
use App\Entity\User;
use App\Repository\EvaluationRepository;
use App\Repository\SkillRepository;
use Symfony\Component\Uid\Uuid;

class EvaluationService
{
    private Evaluation $newEvaluation;

    public function __construct(private EvaluationRepository $evaluationRepo, private SkillRepository $skillRepo)
    {
    }

    public function getLastUserEvaluation(User $user)
    {
        //Récupération de la dernière évaluation de l'utilisateur connecté
        $lastEval = $this->evaluationRepo->findOneBy(['user' => $user], ['dateEval' => 'DESC']);

        $idSkill = [];

        //Boucle sur les EvaluationSkills de la dernière évaluation récupérée
        //Récupère et range dans un array les ids de chaque EvaluationSkills
        foreach ($lastEval->getEvaluationSkills() as $evaluationSkill){

            $idSkill[] = Uuid::fromString($evaluationSkill->getSkill()->getId())->toBinary();
        }

        //Appel la fonction findOthers d'EvaluationRepository et lui passe l'array $idSkill
        //Créer un tableau $skills contenant tous les skills non présents dans la dernière évaluation
        $skills = $this->skillRepo->findOthers($idSkill);

        //Boucle sur les $skills non évaluée lors de la dernière évaluation
        //Pour les ajouter de façon vierge à la dernière Evaluation
        foreach ($skills as $skill){
            $lastEval->addEvaluationSkill((new EvaluationSkill())->setSkill($skill));
        }

        return $lastEval;
    }
}