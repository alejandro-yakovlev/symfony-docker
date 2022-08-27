<?php

declare(strict_types=1);

namespace App\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandHandlerInterface;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Domain\Repository\UserRepositoryInterface;

class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository, private readonly UserFactory $userFactory)
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
