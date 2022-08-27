<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Skills;

use App\Skills\Domain\Factory\SkillFactory;
use App\Skills\Domain\Factory\SkillGroupFactory;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SkillFixture extends Fixture
{
    use FakerTools;

    public const REFERENCE = 'skill';

    public function __construct(
        private readonly SkillFactory $skillFactory,
        private readonly SkillGroupFactory $skillGroupFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $skillGroup = $this->skillGroupFactory->create($this->getFaker()->name());
        $skill = $this->skillFactory->create($this->getFaker()->name(), $skillGroup);

        $manager->persist($skill);
        $manager->flush();

        $this->addReference(self::REFERENCE, $skill);
    }
}
