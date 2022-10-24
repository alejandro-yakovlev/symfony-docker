<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkills;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillDTO;
use App\Skills\Domain\Entity\Skill\Skill;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

class FindSkillsQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly SkillRepositoryInterface $skillRepository)
    {
    }

    public function __invoke(FindSkillsQuery $query): FindSkillsQueryResult
    {
        $skills = array_map(
            fn (Skill $skill) => SkillDTO::fromEntity($skill),
            $this->skillRepository->findByIds($query->ids)
        );

        return new FindSkillsQueryResult($skills);
    }
}
