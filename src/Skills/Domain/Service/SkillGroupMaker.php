<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Skill\SkillGroup;
use App\Skills\Domain\Factory\SkillGroupFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

final readonly class SkillGroupMaker
{
    public function __construct(
        private SkillGroupFactory $skillGroupFactory,
        private SkillGroupRepositoryInterface $skillGroupRepository
    ) {
    }

    public function make(string $name, string $ownerId): SkillGroup
    {
        $skillGroup = $this->skillGroupFactory->create($name, $ownerId);
        $this->skillGroupRepository->add($skillGroup);

        return $skillGroup;
    }
}
