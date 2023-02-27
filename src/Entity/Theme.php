<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?uuid $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: Skill::class)]
    #[ORM\JoinColumn(name: 'id_skill', referencedColumnName: 'id')]
    private Collection $skills;

    #[ORM\OneToMany(mappedBy: 'theme', targetEntity: CustomSkill::class)]
    #[ORM\JoinColumn(name: 'id_custom_skill', referencedColumnName: 'id')]
    private Collection $customSkills;

    #[ORM\Column(length: 10)]
    private ?string $refCode = null;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->customSkills = new ArrayCollection();
    }

    public function getId(): ?uuid
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<string, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
            $skill->setTheme($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getTheme() === $this) {
                $skill->setTheme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomSkill>
     */
    public function getCustomSkills(): Collection
    {
        return $this->customSkills;
    }

    public function addCustomSkill(CustomSkill $customSkill): self
    {
        if (!$this->customSkills->contains($customSkill)) {
            $this->customSkills->add($customSkill);
            $customSkill->setTheme($this);
        }

        return $this;
    }

    public function removeCustomSkill(CustomSkill $customSkill): self
    {
        if ($this->customSkills->removeElement($customSkill)) {
            // set the owning side to null (unless already changed)
            if ($customSkill->getTheme() === $this) {
                $customSkill->setTheme(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getRefCode(): ?string
    {
        return $this->refCode;
    }

    public function setRefCode(string $refCode): self
    {
        $this->refCode = $refCode;

        return $this;
    }
}
