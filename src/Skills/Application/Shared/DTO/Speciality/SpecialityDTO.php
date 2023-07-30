<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\DTO\Speciality;

readonly class SpecialityDTO
{
    /**
     * @param SpecialitySkillDTO[] $skills
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $description = null,
        public ?string $publicationStatus = null,
        public ?array $skills = null,
    ) {
    }
}
