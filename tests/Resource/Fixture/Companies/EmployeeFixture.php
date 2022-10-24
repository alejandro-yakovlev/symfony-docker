<?php

declare(strict_types=1);

namespace App\Tests\Resource\Fixture\Companies;

use App\Companies\Domain\Entity\Company\Company;
use App\Companies\Domain\Entity\Employee\Contact;
use App\Companies\Domain\Factory\EmployeeFactory;
use App\Tests\Tools\FakerTools;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmployeeFixture extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    use FakerTools;

    public const REFERENCE = 'employee';

    public function __construct(
        private readonly EmployeeFactory $employeeFactory,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        /** @var Company $company */
        $company = $this->getReference(CompanyFixture::REFERENCE);
        $contact = new Contact(
            $this->getFaker()->firstName(),
            $this->getFaker()->lastName(),
            $this->getFaker()->email(),
        );
        $employee = $this->employeeFactory->create($company->getOwner()->getId(), $contact, $company);

        $manager->persist($employee);
        $manager->flush();

        $this->addReference(self::REFERENCE, $employee);
    }

    public function getDependencies(): array
    {
        return [
            CompanyFixture::class,
        ];
    }

    public static function getGroups(): array
    {
        return [FixtureGroup::GROUP];
    }
}
