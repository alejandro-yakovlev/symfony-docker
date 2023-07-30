<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSkillGroup;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Domain\Factory\SkillGroupFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

readonly class CreateSkillGroupCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillGroupRepositoryInterface $skillGroupRepository,
        private SkillGroupFactory $skillGroupFactory,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(CreateSkillGroupCommand $command): CreateSkillGroupCommandResult
    {
        $skillGroup = $this->skillGroupFactory->create(
            $command->name,
            $this->userFetcher->requiredUser()->getId()
        );
        $this->skillGroupRepository->add($skillGroup);

        return new CreateSkillGroupCommandResult($skillGroup->getId());
    }
}
