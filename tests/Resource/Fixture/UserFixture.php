<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture;

use App\Tests\Tools\FakerTools;
use App\Users\Domain\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    use FakerTools;

    const REFERENCE = 'user';

    public function load(ObjectManager $manager)
    {
        $email = $this->getFaker()->email();
        $password = $this->getFaker()->password();
        $user = (new UserFactory())->create($email, $password);

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::REFERENCE, $user);
    }
}