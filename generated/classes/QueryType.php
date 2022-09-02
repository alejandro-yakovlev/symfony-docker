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
final class QueryType extends ObjectType implements GeneratedTypeInterface, AliasedInterface
{
    public const NAME = 'Query';

    public function __construct(ConfigProcessor $configProcessor, GraphQLServices $services)
    {
        $config = [
            'name' => self::NAME,
            'description' => 'Запросы модуля навыков.',
            'fields' => fn () => [
                'findSkillGroupById' => [
                    'type' => fn () => $services->getType('SkillGroup'),
                    'resolve' => function ($value, $args, $context, $info) use ($services) {
                        return $services->query('findSkillGroupById', $args['id']);
                    },
                    'description' => 'Найти группу навыков по идентификатору.',
                    'args' => [
                        [
                            'name' => 'id',
                            'type' => Type::nonNull(Type::string()),
                            'description' => 'ID групп навыков',
                        ],
                    ],
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
