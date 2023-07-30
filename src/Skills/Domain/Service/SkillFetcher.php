<?php

declare(strict_types=1);

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class SkillFetcher
{
    public function __construct(private SkillRepositoryInterface $skillRepository)
    {
    }

    public function getRequiredSkill(string $skillId): Skill
    {
        $skill = $this->skillRepository->findOneById($skillId);
        Assert::notNull($skill, 'Навык не найден');

        return $skill;
    }
}
