<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Users;

use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadUserAvatarGQ implements MutationInterface, AliasedInterface
{
    public function __invoke(UploadedFile $file): string
    {
        return $file->getBasename();
    }

    public static function getAliases(): array
    {
        return ['__invoke' => 'uploadUserAvatar'];
    }
}
