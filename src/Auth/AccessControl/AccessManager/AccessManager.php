<?php

declare(strict_types=1);

namespace App\Auth\AccessControl\AccessManager;

use Symfony\Component\Security\Core\Security;

/**
 * Менеджер проверки прав доступа на основе атрибутов.
 */
class AccessManager implements AccessMangerInterface
{
    // добавить на слой application авторизаторы под команды и запросы с правилами,
    // а на инфраструктурном - вотеры,
    // продемонстрировать в кофиге security и контроллерах доступ к эндпоинтам для админов, аутентифицированных и подтвержденных пользователей
    public function __construct(
        private readonly Security $security
    ) {
    }

    final public function isGranted(mixed $attributes, mixed $object = null): bool
    {
        return $this->security->isGranted($attributes, $object);
    }
}
