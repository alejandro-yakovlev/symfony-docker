<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\GetPagedSkills;

use App\Shared\Domain\Repository\Pager;
use App\Skills\Application\Shared\DTO\Skill\SkillDTO;

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
