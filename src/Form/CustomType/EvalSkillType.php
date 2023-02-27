<?php

namespace App\Form\CustomType;

use App\Entity\EvaluationSkill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvalSkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('skillLvl', ChoiceType::class, [
                'required' => false,
                'multiple' => false,
                'expanded' => true,
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('appreciationLvl', ChoiceType::class, [
                'required' => false,
                'multiple' => false,
                'expanded' => true,
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
            ])
            ->add('expert', CheckboxType::class, [
                'required' => false,
            ])
            ->add('certified', CheckboxType::class, [
                'required' => false,

            ])
            ->add('speaker', CheckboxType::class, [
                'required' => false,
            ])
            ->add('former', CheckboxType::class, [
                'required' => false,
            ])
            ->add('concerned', CheckboxType::class, [
                'required' => false,
                'data' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EvaluationSkill::class,
        ]);
    }
}