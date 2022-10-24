<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateAnswerOption;

use App\Auth\AccessControl\AccessManager\AccessMangerInterface;
use App\Auth\CQRSAuthorizer\Authorizer;
use App\Shared\Domain\Service\AssertService;
use App\Testing\Application\Voter\TestVoterInterface;
use App\Testing\Domain\Repository\QuestionRepositoryInterface;

class CreateAnswerOptionCommandAuthorizer extends Authorizer
{
    public function __construct(
        private readonly QuestionRepositoryInterface $questionRepository,
        private readonly AccessMangerInterface $accessManger
    ) {
    }

    /**
     * @param CreateAnswerOptionCommand $command
     */
    public function permitted($command): bool
    {
        $question = $this->questionRepository->findOneById($command->questionId);
        AssertService::notEmpty($question);

        return $this->accessManger->isGranted(TestVoterInterface::EDIT, $question->getTest());
    }
}
