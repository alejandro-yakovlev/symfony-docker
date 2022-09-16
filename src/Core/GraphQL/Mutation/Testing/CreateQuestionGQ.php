<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Testing;

use App\Core\Adapter\TestingAdapter;
use App\Core\GraphQL\Mutation\AliasedMutation;
use App\Core\GraphQL\Type\Testing\QuestionGQ;
use GraphQL\Error\UserError;
use InvalidArgumentException;

class CreateQuestionGQ extends AliasedMutation
{
    public function __construct(
        private readonly TestingAdapter $testingAdapter,
    ) {
    }

    public function __invoke(
        string $name,
        string $description,
        string $type,
        string $testId,
    ): QuestionGQ {
        try {
            $question = $this->testingAdapter->createQuestion($name, $description, $type, $testId);
        } catch (InvalidArgumentException $exception) {
            throw new UserError($exception->getMessage(), 0, $exception);
        }

        return $question;
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createQuestion'];
    }
}
