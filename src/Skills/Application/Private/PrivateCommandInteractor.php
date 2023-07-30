<?php

declare(strict_types=1);

namespace App\Skills\Application\Private;

use App\Shared\Application\Command\CommandBusInterface;
use App\Skills\Application\Private\Command\AddSkillToSpeciality\AddSkillToSpecialityCommand;
use App\Skills\Application\Private\Command\AddSkillToSpeciality\AddSkillToSpecialityCommandResult;
use App\Skills\Application\Private\Command\CreateSkill\CreateSkillCommand;
use App\Skills\Application\Private\Command\CreateSkill\CreateSkillCommandResult;
use App\Skills\Application\Private\Command\CreateSkillGroup\CreateSkillGroupCommand;
use App\Skills\Application\Private\Command\CreateSkillGroup\CreateSkillGroupCommandResult;
use App\Skills\Application\Private\Command\CreateSpeciality\CreateSpecialityCommand;
use App\Skills\Application\Private\Command\CreateSpeciality\CreateSpecialityCommandResult;
use App\Skills\Application\Private\Command\DeleteSpeciality\DeleteSpecialityCommand;
use App\Skills\Application\Private\Command\RemoveSkillFromSpeciality\RemoveSkillFromSpecialityCommand;
use App\Skills\Application\Private\Command\UpdateSpeciality\UpdateSpecialityCommand;
use App\Skills\Application\Private\Command\UpdateSpecialityPublicationStatus\UpdateSpecialityPublicationStatusCommand;
use App\Skills\Application\Public\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\Shared\DTO\Speciality\SpecialityDTO;

readonly class PrivateCommandInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function createSkill(string $name, string $skillGroupId): CreateSkillCommandResult
    {
        $command = new CreateSkillCommand($name, $skillGroupId);

        return $this->commandBus->execute($command);
    }

    public function createSkillGroup(string $name): CreateSkillGroupCommandResult
    {
        $command = new CreateSkillGroupCommand($name);

        return $this->commandBus->execute($command);
    }

    public function createSpeciality(string $name): CreateSpecialityCommandResult
    {
        $command = new CreateSpecialityCommand($name);

        return $this->commandBus->execute($command);
    }

    public function addSkillToSpeciality(
        string $skillId,
        string $specialityId,
        string $level
    ): AddSkillToSpecialityCommandResult {
        $command = new AddSkillToSpecialityCommand($skillId, $specialityId, $level);

        return $this->commandBus->execute($command);
    }

    public function deleteSpeciality(string $specialityId): void
    {
        $command = new DeleteSpecialityCommand($specialityId);
        $this->commandBus->execute($command);
    }

    public function updateSpecialityPublicationStatus(string $specialityId, string $publicationStatus): void
    {
        $command = new UpdateSpecialityPublicationStatusCommand($specialityId, $publicationStatus);
        $this->commandBus->execute($command);
    }

    public function removeSkillFromSpeciality(string $specialitySkillId): void
    {
        $command = new RemoveSkillFromSpecialityCommand($specialitySkillId);
        $this->commandBus->execute($command);
    }

    public function updateSpeciality(string $specialityId, SpecialityDTO $specialityDTO): void
    {
        $command = new UpdateSpecialityCommand($specialityId, $specialityDTO);
        $this->commandBus->execute($command);
    }

    public function confirmSpecialistSkill(ConfirmSpecialistSkillCommand $param): void
    {
        $this->commandBus->execute($param);
    }
}
