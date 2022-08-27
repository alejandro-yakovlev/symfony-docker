<?php

namespace App\Skills\Domain\Entity\Specialist;

/**
 * Уровень владения навыком
 */
enum Level: int
{
    /*
     * Не знаю.
     */
    case DONT_KNOW = 0;
    /*
     * Знаю.
     */
    case KNOW = 2;
    /*
     * Применяю.
     */
    case USE = 4;
    /*
     * Эксперт.
     */
    case EXPERT = 8;
}
