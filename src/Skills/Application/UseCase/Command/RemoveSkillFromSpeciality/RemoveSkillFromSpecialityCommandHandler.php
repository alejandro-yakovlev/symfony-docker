<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase\Command\RemoveSkillFromSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Domain\Repository\SpecialitySkillRepositoryInterface;

readonly class RemoveSkillFromSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(private SpecialitySkillRepositoryInterface $specialitySkillRepository)
    {
    }

    public function __invoke(RemoveSkillFromSpecialityCommand $command): RemoveSkillFromSpecialityCommandResult
    {
        $specialitySkill = $this->specialitySkillRepository->findOne($command->specialitySkillId);
        $this->specialitySkillRepository->remove($specialitySkill);

        return new RemoveSkillFromSpecialityCommandResult();
    }
}
