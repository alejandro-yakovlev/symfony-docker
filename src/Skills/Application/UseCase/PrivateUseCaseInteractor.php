<?php

declare(strict_types=1);

namespace App\Skills\Application\UseCase;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Skills\Application\DTO\Speciality\SpecialityDTO;
use App\Skills\Application\UseCase\Command\AddSkillToSpeciality\AddSkillToSpecialityCommand;
use App\Skills\Application\UseCase\Command\AddSkillToSpeciality\AddSkillToSpecialityCommandResult;
use App\Skills\Application\UseCase\Command\ConfirmSpecialistSkill\ConfirmSpecialistSkillCommand;
use App\Skills\Application\UseCase\Command\CreateSkill\CreateSkillCommand;
use App\Skills\Application\UseCase\Command\CreateSkill\CreateSkillCommandResult;
use App\Skills\Application\UseCase\Command\CreateSkillGroup\CreateSkillGroupCommand;
use App\Skills\Application\UseCase\Command\CreateSkillGroup\CreateSkillGroupCommandResult;
use App\Skills\Application\UseCase\Command\CreateSpeciality\CreateSpecialityCommand;
use App\Skills\Application\UseCase\Command\CreateSpeciality\CreateSpecialityCommandResult;
use App\Skills\Application\UseCase\Command\DeleteSpeciality\DeleteSpecialityCommand;
use App\Skills\Application\UseCase\Command\RemoveSkillFromSpeciality\RemoveSkillFromSpecialityCommand;
use App\Skills\Application\UseCase\Command\UpdateSpeciality\UpdateSpecialityCommand;
use App\Skills\Application\UseCase\Command\UpdateSpecialityPublicationStatus\UpdateSpecialityPublicationStatusCommand;
use App\Skills\Application\UseCase\Query\FindMySpeciality\FindMySpecialityQuery;
use App\Skills\Application\UseCase\Query\FindMySpeciality\FindMySpecialityQueryResult;
use App\Skills\Application\UseCase\Query\FindSkill\FindSkillQuery;
use App\Skills\Application\UseCase\Query\FindSkill\FindSkillQueryResult;
use App\Skills\Application\UseCase\Query\FindSkillGroup\FindSkillGroupQuery;
use App\Skills\Application\UseCase\Query\FindSkillGroup\FindSkillGroupQueryResult;
use App\Skills\Application\UseCase\Query\FindSpeciality\FindSpecialityQuery;
use App\Skills\Application\UseCase\Query\FindSpeciality\FindSpecialityQueryResult;
use App\Skills\Application\UseCase\Query\FindSpecialitySkill\FindSpecialitySkillQuery;
use App\Skills\Application\UseCase\Query\FindSpecialitySkill\FindSpecialitySkillQueryResult;
use App\Skills\Application\UseCase\Query\GetMyPagedSpecialities\GetMyPagedSpecialitiesQuery;
use App\Skills\Application\UseCase\Query\GetMyPagedSpecialities\GetMyPagedSpecialitiesQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSkillGroups\GetPagedSkillGroupsQuery;
use App\Skills\Application\UseCase\Query\GetPagedSkillGroups\GetPagedSkillGroupsQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSkills\GetPagedSkillsQuery;
use App\Skills\Application\UseCase\Query\GetPagedSkills\GetPagedSkillsQueryResult;
use App\Skills\Application\UseCase\Query\GetPagedSpecialities\GetPagedSpecialitiesQuery;
use App\Skills\Application\UseCase\Query\GetPagedSpecialities\GetPagedSpecialitiesQueryResult;
use App\Skills\Domain\Repository\SpecialityFilter;

readonly class PrivateUseCaseInteractor
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private QueryBusInterface $queryBus,
    ) {
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

    public function findSkill(string $id): FindSkillQueryResult
    {
        $query = new FindSkillQuery($id);

        return $this->queryBus->execute($query);
    }

    public function findSkillGroup(string $id): FindSkillGroupQueryResult
    {
        $query = new FindSkillGroupQuery($id);

        return $this->queryBus->execute($query);
    }

    /**
     * @deprecated
     */
    public function getPagedSkillGroups(GetPagedSkillGroupsQuery $query): GetPagedSkillGroupsQueryResult
    {
        return $this->queryBus->execute($query);
    }

    /**
     * @deprecated
     */
    public function getPagedSkills(GetPagedSkillsQuery $query): GetPagedSkillsQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function findSpeciality(string $specialityId): FindSpecialityQueryResult
    {
        $query = new FindSpecialityQuery($specialityId);

        return $this->queryBus->execute($query);
    }

    public function findMySpeciality(string $id): FindMySpecialityQueryResult
    {
        $query = new FindMySpecialityQuery($id);

        return $this->queryBus->execute($query);
    }

    public function findSpecialitySkill(string $specialitySkillId): FindSpecialitySkillQueryResult
    {
        $query = new FindSpecialitySkillQuery($specialitySkillId);

        return $this->queryBus->execute($query);
    }

    /**
     * @deprecated
     */
    public function getPagedSpecialities(GetPagedSpecialitiesQuery $query): GetPagedSpecialitiesQueryResult
    {
        return $this->queryBus->execute($query);
    }

    public function getMyPagedSpecialities(SpecialityFilter $filter): GetMyPagedSpecialitiesQueryResult
    {
        $query = new GetMyPagedSpecialitiesQuery($filter);

        return $this->queryBus->execute($query);
    }
}
