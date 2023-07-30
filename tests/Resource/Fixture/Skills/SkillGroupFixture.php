<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Skills;

use App\Skills\Domain\Factory\SkillGroupFactory;
use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Tests\Tools\FakerTools;
use App\Users\Domain\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SkillGroupFixture extends Fixture implements DependentFixtureInterface
{
    use FakerTools;

    public const REFERENCE = 'skill-group';

    public function __construct(
        private readonly SkillGroupFactory $skillGroupFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /** @var User $user */
        $user = $this->getReference(UserFixture::REFERENCE);
        $skillGroup = $this->skillGroupFactory->create($this->getFaker()->name(), $user->getId());

        $manager->persist($skillGroup);
        $manager->flush();

        $this->addReference(self::REFERENCE, $skillGroup);
    }

    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}
