<?php

declare(strict_types=1);

namespace App\Auth\CQRSAuthorizer;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Application\Query\QueryInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Мидлвар шины сообщений для авторизации вызова команд и запросов.
 */
class AuthorizationMiddleware implements MiddlewareInterface
{
    public function __construct(private ContainerInterface $container)
    {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $message = $envelope->getMessage();
        if ($message instanceof CommandInterface || $message instanceof QueryInterface) {
            $authorizerClassName = get_class($message).'Authorizer';
            if (!class_exists($authorizerClassName)) {
                return $stack->next()->handle($envelope, $stack);
            }

            /** @var Authorizer $authorizer */
            $authorizer = $this->container->get($authorizerClassName);

            try {
                $authorizer->authorize($message);
            } catch (NotPermittedException $exception) {
                throw new AccessDeniedException('Access Denied.', $exception);
            }
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
