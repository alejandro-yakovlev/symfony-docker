<?php

namespace Overblog\GraphQLBundle\__DEFINITIONS__;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Overblog\GraphQLBundle\Definition\ConfigProcessor;
use Overblog\GraphQLBundle\Definition\GraphQLServices;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Type\GeneratedTypeInterface;

/**
 * THIS FILE WAS GENERATED AND SHOULD NOT BE EDITED MANUALLY.
 */
final class PageInfoType extends ObjectType implements GeneratedTypeInterface, AliasedInterface
{
    public const NAME = 'PageInfo';

    public function __construct(ConfigProcessor $configProcessor, GraphQLServices $services)
    {
        $config = [
            'name' => self::NAME,
            'description' => 'Information about pagination in a connection.',
            'fields' => fn () => [
                'hasNextPage' => [
                    'type' => Type::nonNull(Type::boolean()),
                    'description' => 'When paginating forwards, are there more items?',
                ],
                'hasPreviousPage' => [
                    'type' => Type::nonNull(Type::boolean()),
                    'description' => 'When paginating backwards, are there more items?',
                ],
                'startCursor' => [
                    'type' => Type::string(),
                    'description' => 'When paginating backwards, the cursor to continue.',
                ],
                'endCursor' => [
                    'type' => Type::string(),
                    'description' => 'When paginating forwards, the cursor to continue.',
                ],
            ],
        ];

        parent::__construct($configProcessor->process($config));
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [self::NAME];
    }
}
