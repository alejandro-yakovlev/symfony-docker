<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Factory\SkillFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

final readonly class SkillMaker
{
    public function __construct(
        private SkillFactory $skillFactory,
        private SkillRepositoryInterface $skillRepository,
        private SkillGroupRepositoryInterface $skillGroupRepository
    ) {
    }

    public function make(string $name, string $skillGroupId, string $ownerId): Skill
    {
        $skillGroup = $this->skillGroupRepository->findOneById($skillGroupId);
        $skill = $this->skillFactory->create($name, $skillGroup, $ownerId);
        $this->skillRepository->add($skill);

        return $skill;
    }
}
