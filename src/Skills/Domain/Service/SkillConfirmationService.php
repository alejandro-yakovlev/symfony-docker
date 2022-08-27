<?php

namespace App\Skills\Domain\Service;

use App\Skills\Domain\Entity\Specialist\Level;
use App\Skills\Domain\Entity\Specialist\Proof;
use App\Skills\Domain\Factory\SkillConfirmationFactory;
use App\Skills\Domain\Repository\SkillConfirmationRepositoryInterface;
use App\Skills\Domain\Repository\SkillRepositoryInterface;
use App\Skills\Domain\Repository\SpecialistRepositoryInterface;

/**
 * Сервис подвержедния навыка.
 */
class SkillConfirmationService
{
    public function __construct(
        private readonly SpecialistRepositoryInterface $specialistRepository,
        private readonly SkillRepositoryInterface $skillRepository,
        private readonly SkillConfirmationFactory $skillConfirmationFactory,
        private readonly SkillConfirmationRepositoryInterface $skillConfirmationRepository
    ) {
    }

    public function confirm(string $globalUserId, string $skillId, string $testId, int $correctAnswersPercentage): void
    {
        $specialist = $this->specialistRepository->findByGlobalUserId($globalUserId);
        $skill = $this->skillRepository->findById($skillId);
        $level = $this->makeLevelFromCorrectAnswersPercentage($correctAnswersPercentage);

        $skillConfirmation = $this->skillConfirmationRepository->findBySpecialist($skillId, $specialist->getId());
        if (!$skillConfirmation) {
            $skillConfirmation = $this->skillConfirmationFactory->create($specialist, $skill);
        }

        // Устанавливаем новый уровень владения навыком, если он повысился по результам теста
        if ($skillConfirmation->getLevel() < $level) {
            $skillConfirmation->setLevel($level);
        }

        // Добавляем док-во подтверждения навыка с помощью теста
        $skillConfirmation->addProof(new Proof($testId));
        $this->skillConfirmationRepository->add($skillConfirmation);
    }

    /**
     * Создать значение уровня владения навыком исходя из ко-ва правильных ответов на тест.
     */
    public function makeLevelFromCorrectAnswersPercentage(int $correctAnswersPercentage): Level
    {
        if ($correctAnswersPercentage < 30) {
            $level = Level::KNOW;
        } elseif ($correctAnswersPercentage < 90) {
            $level = Level::USE;
        } else {
            $level = Level::EXPERT;
        }

        return $level;
    }
}
