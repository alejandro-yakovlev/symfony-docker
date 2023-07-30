<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventListener\Doctrine;

use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Domain\Aggregate\Aggregate;
use App\Shared\Domain\Specification\SpecificationInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PostFlushEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class DomainEventSubscriber implements EventSubscriber
{
    /**
     * @var Aggregate[]
     */
    private array $entities = [];

    private EventBusInterface $eventBus;
    private ContainerInterface $container;

    public function __construct(EventBusInterface $eventBus, ContainerInterface $containerBag)
    {
        $this->eventBus = $eventBus;
        $this->container = $containerBag;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
            Events::postFlush,
            Events::postLoad,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->keepAggregateRoots($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->keepAggregateRoots($args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->keepAggregateRoots($args);
    }

    public function postFlush(PostFlushEventArgs $args): void
    {
        foreach ($this->entities as $entity) {
            foreach ($entity->popEvents() as $event) {
                $this->eventBus->execute($event);
            }
        }
    }

    public function postLoad(LifecycleEventArgs $args): void
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

    private function keepAggregateRoots(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();

        if (!($entity instanceof Aggregate)) {
            return;
        }

        $this->entities[] = $entity;
    }
}
