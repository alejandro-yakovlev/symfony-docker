<?php

declare(strict_types=1);

namespace App\Skills\Application\Command\CreateSkill;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Skills\Domain\Factory\SkillFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use Webmozart\Assert\Assert;

class CreateSkillCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillGroupRepositoryInterface $skillGroupRepository,
        private SkillRepositoryInterface $skillRepository,
        private SkillFactory $skillFactory
    ) {
    }

    /**
     * @return string skill ID
     */
    public function __invoke(CreateSkillCommand $command): string
    {
        $skillGroup = $this->skillGroupRepository->findOneById($command->skillGroupId);
        Assert::notNull($skillGroup, 'Группа навыков не найдена');

        $skill = $this->skillFactory->create($command->name, $skillGroup);
        $this->skillRepository->add($skill);

        return $skill->getId();
    }
}
