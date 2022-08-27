<?php

declare(strict_types=1);

namespace App\Skills\Domain\Entity\Specialist;

use App\Shared\Domain\Service\UlidService;
use App\Shared\Domain\ValueObject\GlobalUserId;
use App\Skills\Domain\Entity\Speciality\Speciality;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Specialist
{
    private string $id;

    private ?GlobalUserId $user = null;

    /**
     * @var Collection<Speciality>
     */
    private Collection $specialties;

    public function __construct()
    {
        $this->id = UlidService::generate();
        $this->specialties = new ArrayCollection();
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

    public function setUser(?GlobalUserId $user): void
    {
        $this->user = $user;
    }
}
