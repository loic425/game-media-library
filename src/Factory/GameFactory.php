<?php

namespace App\Factory;

use App\Entity\Game;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Game>
 */
final class GameFactory extends PersistentObjectFactory
{
    #[\Override]
    public static function class(): string
    {
        return Game::class;
    }

    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->words(2, true),
        ];
    }
}
