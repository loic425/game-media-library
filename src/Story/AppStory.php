<?php

namespace App\Story;

use App\Factory\GameFactory;
use Zenstruck\Foundry\Attribute\AsFixture;
use Zenstruck\Foundry\Story;

#[AsFixture(name: 'main')]
final class AppStory extends Story
{
    public function build(): void
    {
        GameFactory::new(['name' => 'Hollow Knight'])->create();
        GameFactory::new(['name' => 'Hollow Knight: Silksong'])->create();
    }
}
