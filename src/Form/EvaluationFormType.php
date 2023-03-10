<?php

namespace App\Form;

use App\Entity\Evaluation;
use App\Form\CustomType\EvaluationSkillType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('evaluationSkills', CollectionType::class, [
            'entry_type' => EvaluationSkillType::class,
            //            'entry_options' => [
            //                'label' => false
            //            ],
            //            'label' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
