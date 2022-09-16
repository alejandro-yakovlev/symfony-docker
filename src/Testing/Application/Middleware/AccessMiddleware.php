<?php

declare(strict_types=1);

namespace App\Testing\Application\Middleware;

use App\Shared\Application\Command\CommandInterface;
use App\Shared\Infrastructure\Security\PermissionChecker;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Webmozart\Assert\Assert;

class AccessMiddleware implements MiddlewareInterface
{
    public function __construct(private readonly PermissionChecker $permissionChecker)
    {
    }

    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        if ($envelope->getMessage() instanceof CommandInterface) {
            Assert::true(
                $this->permissionChecker->denyAccessUnlessGranted('execute', $envelope->getMessage())
            );
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
