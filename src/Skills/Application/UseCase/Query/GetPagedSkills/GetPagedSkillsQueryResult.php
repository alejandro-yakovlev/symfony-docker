<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\GetPagedSkills;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\DTO\Skill\SkillDTO;

readonly class GetPagedSkillsQueryResult
{
    /**
     * @param SkillDTO[] $skills
     */
    public function __construct(
        public array $skills,
        public Pager $pager
    ) {
    }
}
