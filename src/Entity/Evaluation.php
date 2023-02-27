<?php

namespace App\Entity;

use App\Repository\EvaluationRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: EvaluationRepository::class)]
class Evaluation
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEval = null;

    #[ORM\ManyToOne(inversedBy: 'evaluations')]
    #[ORM\JoinColumn(name: 'id_user', referencedColumnName: 'id')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'evaluation', targetEntity: EvaluationSkill::class, fetch: 'EAGER')]
    private collection $evaluationSkills;

    /**
     * @return Collection
     */
    public function getEvaluationSkills(): Collection
    {
        return $this->evaluationSkills;
    }

    /**
     * @param Collection $evaluationSkills
     */
    public function setEvaluationSkills(Collection $evaluationSkills): void
    {
        $this->evaluationSkills = $evaluationSkills;
    }


    public function addEvaluationSkill(EvaluationSkill $evaluationSkill): void
    {
        $this->evaluationSkills->add($evaluationSkill);
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getDateEval(): ?\DateTimeInterface
    {
        return $this->dateEval;
    }

    public function setDateEval(\DateTimeInterface $dateEval): self
    {
        $this->dateEval = $dateEval;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
