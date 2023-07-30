<?php

declare(strict_types=1);

namespace App\Skills\Application\Admin\Command\DeleteSkill;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Service\AssertService;
use App\Skills\Application\Shared\Service\AccessControl\SkillAccessControl;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use App\Skills\Domain\Service\SkillFetcher;

readonly class DeleteSkillCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillFetcher $skillFetcher,
        private SkillRepositoryInterface $skillRepository,
        private UserFetcherInterface $userFetcher,
        private SkillAccessControl $skillAccessControl,
    ) {
    }

    public function __invoke(DeleteSkillCommand $command): DeleteSkillCommandResult
    {
        AssertService::true(
            $this->skillAccessControl
                ->canDeleteSkill($this->userFetcher->requiredUserId(), $command->skillId),
            'Запрещено'
        );

        $skill = $this->skillFetcher->getRequiredSkill($command->skillId);
        $this->skillRepository->delete($skill);

        return new DeleteSkillCommandResult();
    }
}
