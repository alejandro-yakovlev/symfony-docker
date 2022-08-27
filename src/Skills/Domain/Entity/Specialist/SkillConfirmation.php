<?php

declare(strict_types=1);

namespace App\Skills\Domain\Entity\Specialist;

use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Entity\Skill\Skill;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Подтверждение навыка.
 */
class SkillConfirmation
{
    private string $id;

    private Specialist $specialist;

    private Skill $skill;

    /**
     * @var Collection<Proof>
     */
    private Collection $proofs;

    private Level $level = Level::DONT_KNOW;

    public function __construct(Specialist $specialist, Skill $skill)
    {
        $this->id = UlidService::generate();
        $this->specialist = $specialist;
        $this->skill = $skill;
        $this->proofs = new ArrayCollection();
    }

    public function addProof(Proof $proof): void
    {
        // Не добавляем док-во подвтерждения, если док-во с таким же тестом было добавлено ранее
        foreach ($this->proofs as $exProof) {
            if ($exProof->getTestId() === $proof->getTestId()) {
                break;
            }
        }

        $this->proofs->add($proof);
    }

    /**
     * @return Collection<Proof>
     */
    public function getProofs(): Collection
    {
        return $this->proofs;
    }

    public function setLevel(Level $level): void
    {
        $this->level = $level;
    }

    public function getLevel(): Level
    {
        return $this->level;
    }
}
