<?php

namespace App\Tests\Functional\Users\Infrastructure\Repository;

use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    use FakerTools;
    use DITools;

    private UserRepository $repository;
    private Generator $faker;
    private AbstractDatabaseTool $databaseTool;
    private UserFactory $userFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->repository = $this->getService(UserRepository::class);
        $this->userFactory = $this->getService(UserFactory::class);
        $this->faker = $this->getFaker();
        $this->databaseTool = $this->getService(DatabaseToolCollection::class)->get();
    }

    /**
     * Пользователь успешно доабвлен.
     */
    public function test_user_added_successfully(): void
    {
        $email = $this->faker->email();
        $password = $this->faker->password();
        $user = $this->userFactory->create($email, $password);

        // act
        $this->repository->add($user);

        // assert
        $existingUser = $this->repository->findByUlid($user->getId());
        $this->assertEquals($user->getId(), $existingUser->getId());
    }

    public function test_user_found_successfully(): void
    {
        // arrange
        $executor = $this->databaseTool->loadFixtures([UserFixture::class]);
        /** @var User $user */
        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);

        // act
        $existingUser = $this->repository->findByUlid($user->getId());

        // assert
        $this->assertEquals($user->getId(), $existingUser->getId());
    }
}
