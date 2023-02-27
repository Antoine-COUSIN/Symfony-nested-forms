<?php

namespace App\Model;

use App\Entity\CustomSkill;
use App\Entity\Evaluation;
use App\Entity\Skill;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class EvaluationSkillModel
{
//    private ?Uuid $id = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Range(
        notInRangeMessage: 'La valeur ne se trouve pas entre {{ min }} et {{ max }}',
        min: 1,
        max: 5,
    )]
    private ?int $skillLvl = null;

    #[Assert\NotBlank(allowNull: true)]
    #[Assert\Range(
        notInRangeMessage: 'La valeur ne se trouve pas entre {{ min }} et {{ max }}',
        min: 1,
        max: 5,
    )]
    private ?int $appreciationLvl = null;

    #[Assert\NotNull]
    private ?bool $expert = null;

    #[Assert\NotNull]
    private ?bool $certified = null;

    #[Assert\NotNull]
    private ?bool $speaker = null;

    #[Assert\NotNull]
    private ?bool $former = null;

    #[Assert\NotNull]
    private ?bool $concerned = null;

    #[Assert\NotBlank]
    #[Assert\Valid]
    private ?Skill $skill = null;

//    #[Assert\NotBlank(allowNull: true)]
//    #[Assert\Valid]
//    private ?CustomSkill $customSkill = null;

    #[Assert\NotBlank]
    #[Assert\Valid]
    private ?Evaluation $evaluation = null;

//    public function getId(): ?Uuid
//    {
//        return $this->id;
//    }

    public function getSkillLvl(): ?int
    {
        return $this->skillLvl;
    }

    public function setSkillLvl(?int $skillLvl): self
    {
        $this->skillLvl = $skillLvl;

        return $this;
    }

    public function getAppreciationLvl(): ?int
    {
        return $this->appreciationLvl;
    }

    public function setAppreciationLvl(?int $appreciationLvl): self
    {
        $this->appreciationLvl = $appreciationLvl;

        return $this;
    }

    public function isExpert(): ?bool
    {
        return $this->expert;
    }

    public function setExpert(bool $expert): self
    {
        $this->expert = $expert;

        return $this;
    }

    public function isCertified(): ?bool
    {
        return $this->certified;
    }

    public function setCertified(bool $certified): self
    {
        $this->certified = $certified;

        return $this;
    }

    public function isSpeaker(): ?bool
    {
        return $this->speaker;
    }

    public function setSpeaker(bool $speaker): self
    {
        $this->speaker = $speaker;

        return $this;
    }

    public function isFormer(): ?bool
    {
        return $this->former;
    }

    public function setFormer(bool $former): self
    {
        $this->former = $former;

        return $this;
    }

    public function isConcerned(): ?bool
    {
        return $this->concerned;
    }

    public function setConcerned(bool $concerned): self
    {
        $this->concerned = $concerned;

        return $this;
    }

    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    public function setSkill(?Skill $skill): self
    {
        $this->skill = $skill;

        return $this;
    }

//    public function getCustomSkill(): ?CustomSkill
//    {
//        return $this->customSkill;
//    }
//
//    public function setCustomSkill(?CustomSkill $customSkill): self
//    {
//        $this->customSkill = $customSkill;
//
//        return $this;
//    }

    public function getEvaluation(): ?Evaluation
    {
        return $this->evaluation;
    }

    public function setEvaluation(?Evaluation $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    //Partie qui gère la fonction de callback
    //Pour la validation des données

    private function allEvaluationNull(): bool
    {
        return $this->getSkillLvl() === null
            && $this->getAppreciationLvl() === null;
    }

    private function allSpecializationFalse(): bool
    {
        return $this->isExpert() === false
            && $this->isCertified() === false
            && $this->isSpeaker() === false
            && $this->isFormer() === false;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context): void
    {
        if ($this->isConcerned() === false && (!$this->allEvaluationNull() || !$this->allSpecializationFalse())) {
            $context->buildViolation('Non concerné, l\'évaluation ne doit pas être remplie')
                ->atPath('skillLvl')
                ->atPath('appreciationLvl')
                ->atPath('expert')
                ->atPath('certified')
                ->atPath('speaker')
                ->atPath('former')
                ->atPath('concerned')
                ->addViolation();
        }

        if ($this->isConcerned() === true && $this->allEvaluationNull()) {
            $context->buildViolation('Concerné, l\'évaluation n\'est pas complètement remplie')
                ->atPath('skillLvl')
                ->atPath('appreciationLvl')
                ->atPath('concerned')
                ->addViolation();
        }
    }
}