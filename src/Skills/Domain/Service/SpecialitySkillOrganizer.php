<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Speciality\Level;
use App\Skills\Domain\Aggregate\Speciality\SpecialitySkill;
use App\Skills\Domain\Repository\SpecialitySkillRepositoryInterface;
use Webmozart\Assert\Assert;

final readonly class SpecialitySkillOrganizer
{
    public function __construct(
        private SpecialityFetcher $specialityFetcher,
        private SkillFetcher $skillFetcher,
        private SpecialitySkillRepositoryInterface $specialitySkillRepository
    ) {
    }

    /**
     * Добавить навык в специальность.
     */
    public function addSkillToSpeciality(string $skillId, string $specialityId, string $level): SpecialitySkill
    {
        $skill = $this->skillFetcher->getRequiredSkill($skillId);
        $speciality = $this->specialityFetcher->getRequiredSpeciality($specialityId);

        $existingSpecialitySkill = $this->specialitySkillRepository
            ->findOneBySpecialityAndSkill($speciality->getId(), $skill->getId());
        Assert::null($existingSpecialitySkill, 'Навык уже добавлен');

        $specialitySkill = new SpecialitySkill($speciality, $skill, Level::from($level));
        $this->specialitySkillRepository->add($specialitySkill);

        return $specialitySkill;
    }
}
