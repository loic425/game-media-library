<?php

namespace App\Entity;

use App\Repository\GameVideoRepository;
use Doctrine\ORM\Mapping as ORM;
use JoliCode\MediaBundle\DeleteBehavior\Attribute\MediaDeleteBehavior;
use JoliCode\MediaBundle\DeleteBehavior\Strategy;
use JoliCode\MediaBundle\Doctrine\Types as MediaTypes;
use JoliCode\MediaBundle\Model\Media;

#[ORM\Entity(repositoryClass: GameVideoRepository::class)]
class GameVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    public ?Game $game = null;

    #[MediaDeleteBehavior(strategy: Strategy::RESTRICT)]
    #[ORM\Column(type: MediaTypes::MEDIA, nullable: false)]
    public Media $media;
}
