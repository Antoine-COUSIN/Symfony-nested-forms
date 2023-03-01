<?php

namespace App\Controller;

use App\Form\EvalSkillFormType;
use App\Repository\EvaluationRepository;
use App\Repository\UserRepository;
use App\Services\EvaluationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(Request $request, EvaluationService $evaluationService, UserRepository $userRepo, EvaluationRepository $evaluationRepo): Response
    {
        //Récupération de l'utilisateur connecté
        $user = $userRepo->findOneBy(['email' => 'titi@conserto.pro']);

        //Récupération de la dernière évaluation mise à jour
        //Avec les skills non évaluée précédemment
        $newEvaluation = $evaluationService->newEvaluation($user);

        //Création du formulaire auquel on passe la dernière évaluation
        //précédemment récupérée
        $form = $this->createForm(EvalSkillFormType::class, $newEvaluation);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $evaluationRepo->save($form->getData(), true);
        }

        return $this->render('main/index.html.twig', [
            'form' => $form,
        ]);
    }
}



//        $skills = $skillRepo->findAll();
//        $evaluationsSkillsCollection = new EvaluationsSkillsCollectionModel($skills);
//        $form = $this->createForm(EvalSkillFormType::class);
