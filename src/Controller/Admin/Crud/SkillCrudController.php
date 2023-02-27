<?php

namespace App\Controller\Admin\Crud;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Skill')
            ->setEntityLabelInPlural('Skills')
            ->setPageTitle('index', 'Gestion des skills')
            ->setPageTitle('new', 'Création de skills')
            ->setPageTitle('edit', 'Edition de skills');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Dénomination du skill'),
            AssociationField::new('theme', 'Thème associé')
        ];
    }

}
