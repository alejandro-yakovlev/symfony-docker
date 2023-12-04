<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Query\FindSpecialitySkill;

use App\Skills\Application\DTO\Speciality\SpecialitySkillDTO;

final readonly class FindSpecialitySkillQueryResult
{
    public function __construct(public SpecialitySkillDTO $specialitySkill)
    {
    }

    public function onSuccess(callable $callback): self
    {
        $callback($this->specialitySkill);

        return $this;
    }

    public function onError(callable $callback): self
    {
        $callback($this->specialitySkill);

        return $this;
    }
}
