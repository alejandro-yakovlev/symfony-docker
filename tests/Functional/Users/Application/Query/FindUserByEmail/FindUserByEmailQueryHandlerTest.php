<?php

namespace App\Tests\Functional\Users\Application\Query\FindUserByEmail;

use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Tests\Tools\DITools;
use App\Users\Application\DTO\UserDTO;
use App\Users\Application\UseCase\Query\FindUserByEmail\FindUserByEmailQuery;
use App\Users\Domain\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindUserByEmailQueryHandlerTest extends WebTestCase
{
    use DITools;

    private QueryBusInterface $queryBus;
    private AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->queryBus = $this->getService(QueryBusInterface::class);
        $this->databaseTool = $this->getService(DatabaseToolCollection::class)->get();
    }

    public function test_user_created_when_command_executed(): void
    {
        // arrange
        $referenceRepository = $this->databaseTool->loadFixtures([UserFixture::class])->getReferenceRepository();
        /** @var User $user */
        $user = $referenceRepository->getReference(UserFixture::REFERENCE);
        $query = new FindUserByEmailQuery($user->getEmail());

        // act
        $userDTO = $this->queryBus->execute($query);

        // assert
        $this->assertInstanceOf(UserDTO::class, $userDTO);
    }
}
