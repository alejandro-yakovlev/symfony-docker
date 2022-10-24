<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Companies;

use App\Companies\Domain\Entity\Company\ContactPerson;
use App\Companies\Domain\Factory\CompanyFactory;
use App\Shared\Domain\Service\UlidService;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CompanyFixture extends Fixture implements FixtureGroupInterface
{
    use FakerTools;

    public const REFERENCE = 'company';

    public function __construct(
        private readonly CompanyFactory $companyFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $ownerId = UlidService::generate();
        $contactPerson = new ContactPerson(
            $this->getFaker()->firstName(),
            $this->getFaker()->lastName(),
            $this->getFaker()->email(),
            $this->getFaker()->phoneNumber()
        );
        $company = $this->companyFactory->create($ownerId, $this->getFaker()->company(), $contactPerson);

        $manager->persist($company);
        $manager->flush();

        $this->addReference(self::REFERENCE, $company);
    }

    public static function getGroups(): array
    {
        return [FixtureGroup::GROUP];
    }
}
