<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\AddSkillToSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Service\AssertService;
use App\Skills\Application\Shared\Service\AccessControl\SkillAccessControl;
use App\Skills\Domain\Service\SpecialitySkillOrganizer;

readonly class AddSkillToSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SpecialitySkillOrganizer $specialitySkillOrganizer,
        private SkillAccessControl $skillAccessControl,
        private UserFetcherInterface $userFetcher,
    ) {
    }

    public function __invoke(AddSkillToSpecialityCommand $command): AddSkillToSpecialityCommandResult
    {
        AssertService::true(
            $this->skillAccessControl
                ->canAddSkillToSpeciality(
                    $this->userFetcher->requiredUserId(),
                    $command->skillId,
                    $command->specialityId
                ),
            'Запрещено'
        );

        $specialitySkill = $this->specialitySkillOrganizer->addSkillToSpeciality(
            $command->skillId,
            $command->specialityId,
            $command->level
        );

        return new AddSkillToSpecialityCommandResult($specialitySkill->getId());
    }
}
