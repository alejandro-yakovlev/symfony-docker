<?php

declare(strict_types=1);

namespace App\Skills\Application\Public\Query\FindSpecialitySkill;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Skills\Application\Shared\DTO\Speciality\SpecialitySkillDTOTransformer;
use App\Skills\Domain\Repository\SpecialitySkillRepositoryInterface;

readonly class FindSpecialitySkillQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private SpecialitySkillRepositoryInterface $specialitySkillRepository,
        private SpecialitySkillDTOTransformer $specialitySkillDTOTransformer
    ) {
    }

    public function __invoke(FindSpecialitySkillQuery $query): FindSpecialitySkillQueryResult
    {
        $specialitySkill = $this->specialitySkillRepository->findOne($query->id);
        $specialitySkillDTO = $this->specialitySkillDTOTransformer->fromEntity($specialitySkill);

        return new FindSpecialitySkillQueryResult($specialitySkillDTO);
    }
}
