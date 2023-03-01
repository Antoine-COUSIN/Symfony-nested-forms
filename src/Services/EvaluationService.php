<?php

namespace App\Services;

use App\Entity\Evaluation;
use App\Entity\EvaluationSkill;
use App\Entity\User;
use App\Repository\EvaluationRepository;
use App\Repository\SkillRepository;
use Symfony\Component\Uid\Uuid;

class EvaluationService
{
    public function __construct(
        private readonly EvaluationRepository $evaluationRepo,
        private readonly SkillRepository $skillRepo
    ) {
    }

    public function newEvaluation(User $user): Evaluation
    {
        $idSkill = [];

        //Clone la précédente évaluation dans la nouvelle
        //Fait appel en cascade aux méthodes clones des entities Evaluation et EvaluationSkill
        $newEvaluation = clone $this->getLastUserEvaluation($user);

        //Boucle sur les EvaluationSkills récupérées de la dernière évaluation
        //Récupère les ids de chaque EvaluationSkills et les rangent dans un array
        foreach ($this->getLastUserEvaluation($user)->getEvaluationSkills() as $evaluationSkill) {
            $idSkill[] = Uuid::fromString($evaluationSkill->getSkill()->getId())->toBinary();
        }

        //Appel la fonction findOthers d'EvaluationRepository et lui passe l'array $idSkill
        //Créer un tableau $skills contenant tous les skills non présents dans la dernière évaluation
        $skills = $this->skillRepo->findOthers($idSkill);

        //Boucle sur les $skills non évaluée lors de la dernière évaluation
        //Pour les ajouter de façon vierge à la dernière Evaluation
        foreach ($skills as $skill) {
            $newEvaluation->addEvaluationSkill((new EvaluationSkill())->setSkill($skill));
        }

        //Retourne la nouvelle évaluation
        return $newEvaluation;
    }

    private function getLastUserEvaluation(User $user): Evaluation
    {
        //Récupération de la dernière évaluation de l'utilisateur connecté
        return $this->evaluationRepo->findOneBy(['user' => $user], ['dateEval' => 'DESC']);
    }
}
