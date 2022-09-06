<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Testing;

use App\Core\GraphQL\Type\Testing\TestGQ;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Testing\Application\Command\CreateTest\CreateTestCommand;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use App\Testing\Application\Query\FindTestById\FindTestByIdQuery;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CreateTestGQ implements MutationInterface, AliasedInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
        private UserFetcherInterface $userFetcher
    ) {
    }

    public function __invoke(
        string $name,
        string $description,
        string $difficultyLevel,
        int $correctAnswersPercentage,
        ?string $skillId,
    ): array {
        $creatorId = $this->userFetcher->getAuthUser()->getId();
        $testId = $this->commandBus->execute(
            new CreateTestCommand(
                $creatorId, $name, $description, $difficultyLevel, $correctAnswersPercentage, $skillId
            )
        );
        /** @var TestDTO $test */
        $test = $this->queryBus->execute(new FindTestByIdQuery($testId));

        return TestGQ::fromDTO($test)->toArray();
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createTest'];
    }
}
