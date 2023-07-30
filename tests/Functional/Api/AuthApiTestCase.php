<?php

declare(strict_types=1);

namespace App\Tests\Functional\Api;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Tests\Tools\DITools;
use App\Tests\Tools\FixtureTools;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

/**
 * Базовый класс для тестирования API запросов, требующих авторизацию.
 */
class AuthApiTestCase extends ApiTestCase
{
    use FixtureTools;
    use DITools;

    protected AuthUserInterface $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->authenticate();
    }

    public function authenticate(): void
    {
        $this->user = $this->loadUserFixture();
        $jwtEncoder = $this->getService(JWTEncoderInterface::class);
        $this->client->setServerParameter(
            'HTTP_AUTHORIZATION',
            sprintf(
                'Bearer %s',
                $jwtEncoder->encode([
                        'email' => $this->user->getEmail(),
                    ]
                )
            )
        );
    }
}
