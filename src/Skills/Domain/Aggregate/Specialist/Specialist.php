<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\Specialist;

use App\Shared\Domain\Aggregate\Id;
use App\Skills\Domain\Aggregate\Speciality\Speciality;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Специалист.
 */
class Specialist
{
    private string $id;

    private string $publicUserId;

    /**
     * @var Collection<Speciality>
     */
    private Collection $specialties;

    public function __construct(string $publicUserId)
    {
        $this->id = Id::makeUlid();
        $this->specialties = new ArrayCollection();
        $this->publicUserId = $publicUserId;
    }

    public function addSpeciality(Speciality $speciality): void
    {
        if (!$this->specialties->contains($speciality)) {
            $this->specialties->add($speciality);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPublicUserId(): ?string
    {
        return $this->publicUserId;
    }

    public function getSpecialties(): Collection
    {
        return $this->specialties;
    }

    public function setPublicUserId(?string $publicUserId): void
    {
        $this->publicUserId = $publicUserId;
    }
}
