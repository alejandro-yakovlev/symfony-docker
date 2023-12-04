<?php

namespace App\Users\Infrastructure\Console;

use App\Shared\Domain\Security\Role;
use App\Users\Application\UseCase\AdminUseCaseInteractor;
use App\Users\Application\UseCase\Command\CreateUser\CreateUserCommand;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Webmozart\Assert\Assert;

#[AsCommand(
    name: 'app:users:create-user',
    description: 'create user',
)]
final class CreateUserConsoleCommand extends Command
{
    public function __construct(
        private readonly AdminUseCaseInteractor $adminCommandInteractor,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $email = $io->ask(
            'email',
            null,
            function (?string $input) {
                Assert::email($input, 'Email is invalid');

                return $input;
            }
        );

        $password = $io->askHidden(
            'password',
            function (?string $input) {
                Assert::notEmpty($input, 'Password cannot be empty');

                return $input;
            }
        );

        $role = $io->ask(
            'role',
            Role::ROLE_USER,
            function (?string $input) {
                Assert::notEmpty($input, 'Role cannot be empty');

                return $input;
            }
        );

        $command = new CreateUserCommand($email, $password);
        $this->adminCommandInteractor->createUser($command);

        return Command::SUCCESS;
    }
}
