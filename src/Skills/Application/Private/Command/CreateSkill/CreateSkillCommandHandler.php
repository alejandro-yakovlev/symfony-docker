<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\CreateSkill;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Skills\Domain\Factory\SkillFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class CreateSkillCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillGroupRepositoryInterface $skillGroupRepository,
        private SkillRepositoryInterface $skillRepository,
        private SkillFactory $skillFactory,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(CreateSkillCommand $command): CreateSkillCommandResult
    {
        $skillGroup = $this->skillGroupRepository->findOneById($command->skillGroupId);
        Assert::notNull($skillGroup, 'Группа навыков не найдена');

        $skill = $this->skillFactory->create(
            $command->name,
            $skillGroup,
            $this->userFetcher->requiredUser()->getId()
        );
        $this->skillRepository->add($skill);

        return new CreateSkillCommandResult($skill->getId());
    }
}
