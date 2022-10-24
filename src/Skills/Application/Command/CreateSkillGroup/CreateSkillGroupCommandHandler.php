<?php

declare(strict_types=1);

namespace App\Skills\Application\Command\CreateSkillGroup;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Domain\Factory\SkillGroupFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;

class CreateSkillGroupCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillGroupRepositoryInterface $skillGroupRepository,
        private SkillGroupFactory $skillGroupFactory
    ) {
    }

    /**
     * @return string skill group ID
     */
    public function __invoke(CreateSkillGroupCommand $command): string
    {
        $skillGroup = $this->skillGroupFactory->create($command->name);
        $this->skillGroupRepository->add($skillGroup);

        return $skillGroup->getId();
    }
}
