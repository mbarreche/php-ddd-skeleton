<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Domain;

final class WordMother
{
    public static function randomWord(): string
    {
        return MotherCreator::random()->word;
    }

    public static function randomUserEmail(): string
    {
        return MotherCreator::random()->email;
    }

    public static function randomUserPassword(): string
    {
        $minChunk = [
            substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 1),
            substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 1),
            substr(str_shuffle('0123456789'), 0, 1),
            substr(str_shuffle('`-=~!@#$%^&*()_+,./<>?;:[]{}\|'), 0, 1),
        ];
        return str_shuffle(MotherCreator::random()->password(4, 16) . implode('', $minChunk));
    }

    public static function randomUserName(): string
    {
        return MotherCreator::random()->name;
    }
}
