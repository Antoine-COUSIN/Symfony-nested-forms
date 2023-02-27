<?php

namespace App\Controller\Admin\Crud;

use App\Entity\EvaluationSkill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class EvaluationSkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EvaluationSkill::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Skill')
            ->setEntityLabelInPlural('Skills')
            ->setPageTitle('index', 'Gestion des EvalSkills')
            ->setPageTitle('new', 'Création de EvalSkills')
            ->setPageTitle('edit', 'Edition de EvalSkills');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('skillLvl', 'Niveau skill sur la techno'),
            IntegerField::new('appreciationLvl', 'Niveau d\'appréciation de la techno'),
            BooleanField::new('expert', 'Expert'),
            BooleanField::new('certified', 'Certifié'),
            BooleanField::new('speaker', 'Conférencié'),
            BooleanField::new('former', 'Formateur'),
            BooleanField::new('concerned', 'Je suis concerné par cette techno'),
            AssociationField::new('skill', 'Techno évalué'),
            AssociationField::new('evaluation', 'Date de l\'évaluation')
        ];
    }
}
