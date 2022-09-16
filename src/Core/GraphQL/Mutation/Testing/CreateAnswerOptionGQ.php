<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Testing;

use App\Core\Adapter\TestingAdapter;
use App\Core\GraphQL\Mutation\AliasedMutation;
use App\Core\GraphQL\Type\Testing\AnswerOptionGQ;
use GraphQL\Error\UserError;
use InvalidArgumentException;

class CreateAnswerOptionGQ extends AliasedMutation
{
    public function __construct(private readonly TestingAdapter $testingAdapter)
    {
    }

    public function __invoke(
        string $questionId,
        string $description,
        bool $isCorrect,
    ): AnswerOptionGQ {
        try {
            $answerOption = $this->testingAdapter->createAnswerOption($questionId, $description, $isCorrect);
        } catch (InvalidArgumentException $exception) {
            throw new UserError($exception->getMessage());
        }

        return $answerOption;
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'createAnswerOption'];
    }
}
