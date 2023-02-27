<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Evaluation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;

class EvaluationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evaluation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Skill')
            ->setEntityLabelInPlural('Skills')
            ->setPageTitle('index', 'Gestion des évaluations')
            ->setPageTitle('new', 'Création d\'évaluation')
            ->setPageTitle('edit', 'Edition d\'évaluation');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateField::new('dateEval', 'Date de l\'évaluation'),
            AssociationField::new('user', 'Utilisateur de l\'évaluation')
        ];
    }
}
