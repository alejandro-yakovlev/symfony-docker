<?php

declare(strict_types=1);

namespace App\Skills\Application\Private\Command\AddSkillToSpeciality;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Shared\Domain\Service\AssertService;
use App\Skills\Application\Shared\Service\AccessControl\SkillAccessControl;
use App\Skills\Domain\Aggregate\Speciality\Level;
use App\Skills\Domain\Aggregate\Speciality\SpecialitySkill;
use App\Skills\Domain\Repository\SpecialitySkillRepositoryInterface;
use App\Skills\Domain\Service\SkillFetcher;
use App\Skills\Domain\Service\SpecialityFetcher;
use Webmozart\Assert\Assert;

readonly class AddSkillToSpecialityCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private SkillFetcher $skillFetcher,
        private SpecialityFetcher $specialityFetcher,
        private SpecialitySkillRepositoryInterface $specialitySkillRepository,
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

        $skill = $this->skillFetcher->getRequiredSkill($command->skillId);
        $speciality = $this->specialityFetcher->getRequiredSpeciality($command->specialityId);

        $existingSpecialitySkill = $this->specialitySkillRepository
            ->findOneBySpecialityAndSkill($speciality->getId(), $skill->getId());
        Assert::null($existingSpecialitySkill, 'Навык уже добавлен');

        $specialitySkill = new SpecialitySkill($speciality, $skill, Level::from($command->level));
        $this->specialitySkillRepository->add($specialitySkill);

        return new AddSkillToSpecialityCommandResult($specialitySkill->getId());
    }
}
