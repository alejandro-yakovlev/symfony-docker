<?php

declare(strict_types=1);

namespace App\Tests\Tools;

use App\Skills\Domain\Aggregate\Skill\SkillGroup;
use App\Tests\Resource\Fixture\Skills\SkillGroupFixture;
use App\Tests\Resource\Fixture\Users\UserFixture;
use App\Users\Domain\Entity\User;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

trait FixtureTools
{
    public function getDatabaseTools(): AbstractDatabaseTool
    {
        return static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function loadUserFixture(): User
    {
        $executor = $this->getDatabaseTools()->loadFixtures([UserFixture::class], true);
        /** @var User $user */
        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);

        return $user;
    }

    public function loadSkillGroupFixture(): SkillGroup
    {
        $executor = $this->getDatabaseTools()->loadFixtures([SkillGroupFixture::class], true);

        return $executor->getReferenceRepository()->getReference(SkillGroupFixture::REFERENCE);
    }
}
