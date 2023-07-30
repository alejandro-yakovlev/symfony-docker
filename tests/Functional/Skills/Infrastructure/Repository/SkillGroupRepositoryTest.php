<?php

namespace App\Tests\Functional\Skills\Infrastructure\Repository;

use App\Shared\Domain\Aggregate\Id;
use App\Shared\Domain\Service\UlidService;
use App\Skills\Domain\Factory\SkillGroupFactory;
use App\Skills\Domain\Repository\SkillGroupRepositoryInterface;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FakerTools;
use Faker\Generator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Webmozart\Assert\InvalidArgumentException;

class SkillGroupRepositoryTest extends WebTestCase
{
    use FakerTools;
    use DITools;

    private SkillGroupRepositoryInterface $skillGroupRepository;
    private Generator $faker;
    private SkillGroupFactory $skillGroupFactory;

    public function setUp(): void
    {
        parent::setUp();
        $this->skillGroupRepository = $this->getService(SkillGroupRepositoryInterface::class);
        $this->skillGroupFactory = $this->getService(SkillGroupFactory::class);
        $this->faker = $this->getFaker();
    }

    public function test_skill_group_created_successfully(): void
    {
        $name = $this->faker->name();

        // act
        $skillGroup = $this->skillGroupFactory->create($name, Id::makeUlid());
        $this->skillGroupRepository->add($skillGroup);

        // assert
        $existingSkillGroup = $this->skillGroupRepository->findOneByName($name);
        $this->assertEquals($existingSkillGroup->getId(), $skillGroup->getId());
    }

    public function test_skill_group_cant_created_with_duplicate_name(): void
    {
        $name = $this->faker->name();

        // act
        $skillGroup = $this->skillGroupFactory->create($name, UlidService::generate());
        $this->skillGroupRepository->add($skillGroup);

        $this->expectException(InvalidArgumentException::class);
        $this->skillGroupFactory->create($name, UlidService::generate());
    }
}
