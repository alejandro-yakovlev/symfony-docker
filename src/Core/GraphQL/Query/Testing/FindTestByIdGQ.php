<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Query\Testing;

use App\Core\GraphQL\Type\Testing\TestGQ;
use App\Shared\Application\Query\QueryBusInterface;
use App\Testing\Application\Query\DTO\Test\TestDTO;
use App\Testing\Application\Query\FindTestById\FindTestByIdQuery;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\QueryInterface;
use Overblog\GraphQLBundle\Error\UserWarning;

class FindTestByIdGQ implements QueryInterface, AliasedInterface
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    public function __invoke(string $id): array
    {
        /** @var TestDTO $test */
        $test = $this->queryBus->execute(new FindTestByIdQuery($id));

        if (!$test) {
            throw new UserWarning('Тест не найден');
        }

        return TestGQ::fromDTO($test)->toArray();
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return ['__invoke' => 'findTestById'];
    }
}
