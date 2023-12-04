<?php

declare(strict_types=1);

namespace App\Users\Application\UseCase\Command\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

readonly class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private UserRepositoryInterface $userRepository, private UserFactory $userFactory)
    {
    }

    /**
     * @return string UserId
     */
    public function __invoke(CreateUserCommand $createUserCommand): string
    {
        $user = $this->userFactory->create($createUserCommand->email, $createUserCommand->password);
        $this->userRepository->add($user);

        return $user->getId();
    }
}
