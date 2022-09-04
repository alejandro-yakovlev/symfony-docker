<?php

declare(strict_types=1);

namespace App\Skills\Application\Query\FindSkillGroupById;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\DTO\SkillGroupDTO;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class FindSkillGroupByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly SkillGroupRepositoryInterface $skillGroupRepository)
    {
    }

    public function __invoke(FindSkillGroupByIdQuery $query): ?SkillGroupDTO
    {
        $skillGroup = $this->skillGroupRepository->findOneById($query->id);

        if (!$skillGroup) {
            return null;
        }

        return SkillGroupDTO::fromEntity($skillGroup);
    }
}
