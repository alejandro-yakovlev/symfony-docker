<?php

declare(strict_types=1);

namespace App\Testing\Application\Command\CreateQuestion;

use App\Auth\AccessControl\AccessManager\AccessMangerInterface;
use App\Auth\CQRSAuthorizer\Authorizer;
use App\Shared\Domain\Service\AssertService;
use App\Testing\Application\Voter\TestVoterInterface;
use App\Testing\Domain\Repository\TestRepositoryInterface;

class CreateQuestionCommandAuthorizer extends Authorizer
{
    public function __construct(
        private readonly TestRepositoryInterface $testRepository,
        private readonly AccessMangerInterface $accessManger
    ) {
    }

    /**
     * @param CreateQuestionCommand $command
     */
    public function permitted($command): bool
    {
        $test = $this->testRepository->findOneById($command->testId);
        AssertService::notEmpty($test);

        return $this->accessManger->isGranted(TestVoterInterface::EDIT, $test);
    }
}
