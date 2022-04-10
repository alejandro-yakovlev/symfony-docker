<?php

namespace App\Tests\Functional\Users\Application\Command\CreateUser;

use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\Tools\FakerTools;
use App\Users\Application\Command\CreateUser\CreateUserCommand;
use App\Users\Domain\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserCommandHandlerTest extends WebTestCase
{
    use FakerTools;

    private CommandBusInterface $commandBus;
    private UserRepositoryInterface $userRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->commandBus = $this::getContainer()->get(CommandBusInterface::class);
        $this->userRepository = $this::getContainer()->get(UserRepositoryInterface::class);
    }

    public function test_user_created_successfully(): void
    {
        $command = new CreateUserCommand($this->getFaker()->email(), $this->getFaker()->password());

        // act
        $userUlid = $this->commandBus->execute($command);

        // assert
        $user = $this->userRepository->findByUlid($userUlid);
        $this->assertNotEmpty($user);
    }
}
