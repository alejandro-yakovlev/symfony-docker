<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Testing;

use App\Core\Adapter\TestingAdapter;
use App\Core\GraphQL\Mutation\AliasedMutation;
use App\Core\GraphQL\Type\Testing\TestGQ;
use App\Shared\Domain\Security\UserFetcherInterface;
use GraphQL\Error\UserError;
use InvalidArgumentException;

class CreateTestGQ extends AliasedMutation
{
    public function __construct(
        private readonly TestingAdapter $testingAdapter,
        private readonly UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(
        string $name,
        string $description,
        string $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): TestGQ {
        $creatorId = $this->userFetcher->getAuthUser()->getId();

        try {
            $test = $this->testingAdapter->createTest(
                $creatorId,
                $name,
                $description,
                $difficultyLevel,
                $correctAnswersPercentage,
                $skillId
            );
        } catch (InvalidArgumentException $exception) {
            throw new UserError($exception->getMessage());
        }

        return $test;
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createTest'];
    }
}
