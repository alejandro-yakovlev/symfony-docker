<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Testing;

use App\Core\GraphQL\Type\Testing\QuestionGQ;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Security\AuthChecker;
use App\Testing\Application\Command\CreateQuestion\CreateQuestionCommand;
use App\Testing\Application\Query\DTO\Test\QuestionDTO;
use App\Testing\Application\Query\FindQuestionById\FindQuestionByIdQuery;
use App\Testing\Application\Query\FindTestById\FindTestByIdQuery;
use App\Testing\Infrastructure\Security\Voter\TestVoter;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

class CreateQuestionGQ implements MutationInterface, AliasedInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private CommandBusInterface $commandBus,
        private AuthChecker $authChecker,
    ) {
    }

    public function __invoke(
        string $name,
        string $description,
        string $type,
        string $testId,
    ): array {
        $test = $this->queryBus->execute(new FindTestByIdQuery($testId));
        $this->authChecker->denyAccessUnlessGranted(TestVoter::EDIT, $test);

        $questionId = $this->commandBus->execute(
            new CreateQuestionCommand($name, $description, $type, $testId)
        );
        /** @var QuestionDTO $question */
        $question = $this->queryBus->execute(new FindQuestionByIdQuery($questionId));

        return QuestionGQ::fromDTO($question)->toArray();
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createQuestion'];
    }
}
