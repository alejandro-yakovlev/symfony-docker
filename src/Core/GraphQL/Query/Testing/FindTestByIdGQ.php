<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Testing;

use App\Core\Adapter\TestingAdapter;
use App\Core\GraphQL\Query\AliasedQuery;
use App\Core\GraphQL\Type\Testing\TestGQ;
use Overblog\GraphQLBundle\Error\UserWarning;

class FindTestByIdGQ extends AliasedQuery
{
    public function __construct(private readonly TestingAdapter $testingAdapter)
    {
    }

    public function __invoke(string $id): TestGQ
    {
        $test = $this->testingAdapter->findTest($id);

        if (!$test) {
            throw new UserWarning('Тест не найден');
        }

        return $test;
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'findTestById'];
    }
}
