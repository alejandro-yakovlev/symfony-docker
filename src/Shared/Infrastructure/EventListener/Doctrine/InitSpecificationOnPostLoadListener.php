<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventListener\Doctrine;

use App\Shared\Domain\Specification\SpecificationInterface;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostLoadEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

#[AsDoctrineListener(event: Events::postLoad)]
final readonly class InitSpecificationOnPostLoadListener
{
    public function __construct(private ContainerBagInterface $container)
    {
    }

    public function postLoad(PostLoadEventArgs $args): void
    {
        $entity = $args->getObject();

        $reflect = new \ReflectionClass($entity);

        foreach ($reflect->getProperties() as $property) {
            $type = $property->getType();

            if (is_null($type) || $property->isInitialized($entity)) {
                continue;
            }

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                // initialize specifications
                $interfaces = class_implements($type->getName());
                if (isset($interfaces[SpecificationInterface::class])) {
                    $property->setValue($entity, $this->container->get($type->getName()));
                }
            }
        }
    }
}
