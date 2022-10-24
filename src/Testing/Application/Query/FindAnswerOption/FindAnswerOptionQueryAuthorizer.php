<?php

declare(strict_types=1);

namespace App\Testing\Application\Query\FindAnswerOption;

use App\Auth\AccessControl\AccessManager\AccessMangerInterface;
use App\Auth\CQRSAuthorizer\Authorizer;
use App\Shared\Domain\Service\AssertService;
use App\Testing\Application\Voter\TestVoterInterface;
use App\Testing\Domain\Repository\AnswerOptionRepositoryInterface;

class FindAnswerOptionQueryAuthorizer extends Authorizer
{
    public function __construct(
        private readonly AnswerOptionRepositoryInterface $answerOptionRepository,
        private readonly AccessMangerInterface $accessManger
    ) {
    }

    /**
     * @param FindAnswerOptionQuery $query
     */
    public function permitted($query): bool
    {
        $answerOption = $this->answerOptionRepository->findOneById($query->answerOptionId);
        AssertService::notEmpty($answerOption);

        return $this->accessManger->isGranted(
            TestVoterInterface::EDIT,
            $answerOption->getQuestion()->getTest()
        );
    }
}
