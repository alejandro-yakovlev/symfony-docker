<?php

namespace App\Skills\Domain\Aggregate\Skill\Specification;

use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\SpecificationInterface;
use App\Skills\Domain\Aggregate\Skill\Skill;
use App\Skills\Domain\Repository\SkillRepositoryInterface;

readonly class UniqueSkillInGroupSpecification implements SpecificationInterface
{
    public function __construct(private SkillRepositoryInterface $skillRepository)
    {
    }

    public function satisfy(Skill $skill): void
    {
        foreach ($this->skillRepository->findByName($skill->getName()) as $foundSkill) {
            if ($skill->getId() === $foundSkill->getId()) {
                continue;
            }

            AssertService::notEq(
                $skill->getSkillGroup(),
                $foundSkill->getSkillGroup(),
                'Навык с таким названием уже имеется в группе'
            );
        }
    }
}
