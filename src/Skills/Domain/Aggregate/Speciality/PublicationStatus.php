<?php

declare(strict_types=1);

namespace App\Skills\Domain\Aggregate\Speciality;

/**
 * Статус публикации специальности.
 */
enum PublicationStatus: string
{
    case DRAFT = 'draft';
    case PUBLISHED = 'published';

    case DELETED = 'deleted';

    public function equals(PublicationStatus $publicationStatus): bool
    {
        return $this->value === $publicationStatus->value;
    }

    public function isDraft(): bool
    {
        return $this->equals(self::DRAFT);
    }

    public function isPublished(): bool
    {
        return $this->equals(self::PUBLISHED);
    }
}
