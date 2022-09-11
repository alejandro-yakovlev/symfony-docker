<?php

declare(strict_types=1);

namespace App\Core\GraphQL\Mutation\Users;

use App\Core\GraphQL\Mutation\AliasedMutation;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadUserAvatarGQ extends AliasedMutation
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
