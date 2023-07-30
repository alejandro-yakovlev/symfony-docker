<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\DTO\Speciality;

use App\Skills\Domain\Aggregate\Speciality\Speciality;

readonly class SpecialityDTOTransformer
{
    public function __construct(private SpecialitySkillDTOTransformer $specialitySkillDTOTransformer)
    {
    }

    public function fromEntity(Speciality $speciality): SpecialityDTO
    {
        $skills = [];
        foreach ($speciality->getSkills()->toArray() as $skill) {
            $skills[] = $this->specialitySkillDTOTransformer->fromEntity($skill);
        }

        return new SpecialityDTO(
            id: $speciality->getId(),
            name: $speciality->getName(),
            description: $speciality->getDescription(),
            publicationStatus: $speciality->getPublicationStatus()->value,
            skills: $skills
        );
    }

    /**
     * @param Speciality[] $specialities
     *
     * @return SpecialityDTO[]
     */
    public function fromEntities(array $specialities): array
    {
        $specialitiesDTO = [];
        foreach ($specialities as $speciality) {
            $specialitiesDTO[] = $this->fromEntity($speciality);
        }

        return $specialitiesDTO;
    }
}
