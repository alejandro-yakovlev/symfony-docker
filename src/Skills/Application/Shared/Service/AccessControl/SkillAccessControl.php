<?php

declare(strict_types=1);

namespace App\Skills\Application\Shared\Service\AccessControl;

use App\Shared\Application\Security\AuthChecker;
use App\Shared\Domain\Security\Role;
use App\Skills\Domain\Service\SkillFetcher;
use App\Skills\Domain\Service\SpecialityFetcher;

/**
 * Служба проверки прав доступа к навыкам
 */
readonly class SkillAccessControl
{
    public function __construct(
        private SkillFetcher $skillFetcher,
        private SpecialityFetcher $specialityFetcher,
        private AuthChecker $authChecker
    ) {
    }

    /**
     * Может ли пользователь удалить навык?
     */
    public function canDeleteSkill(string $userId, string $skillId): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        $skill = $this->skillFetcher->getRequiredSkill($skillId);

        return $skill->isOwnedBy($userId);
    }

    /**
     * Может ли пользователь добавить навык в специальность?
     */
    public function canAddSkillToSpeciality(string $userId, string $skillId, string $specialityId): bool
    {
        if ($this->isAdmin()) {
            return true;
        }

        $skill = $this->skillFetcher->getRequiredSkill($skillId);
        $speciality = $this->specialityFetcher->getRequiredSpeciality($specialityId);

        return $skill->isOwnedBy($userId) && $speciality->isOwnedBy($userId);
    }

    private function isAdmin(): bool
    {
        return $this->authChecker->isGranted(Role::ROLE_ADMIN);
    }
}
