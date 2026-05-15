<?php

namespace App\Entity;

use App\Form\GameType;
use App\Grid\GameGrid;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JoliCode\MediaBundle\DeleteBehavior\Attribute\MediaDeleteBehavior;
use JoliCode\MediaBundle\DeleteBehavior\Strategy;
use JoliCode\MediaBundle\Doctrine\Types as MediaTypes;
use JoliCode\MediaBundle\Model\Media;
use JoliCode\MediaBundle\Validator\Media as MediaConstraint;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\BulkDelete;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;
use Sylius\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[AsResource(
    section: 'admin',
    formType: GameType::class,
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Create(redirectToRoute: 'app_admin_game_update'),
        new Update(redirectToRoute: 'app_admin_game_update'),
        new Delete(),
        new BulkDelete(),
        new Index(grid: GameGrid::class),
        new Show(),
    ],
)]
class Game implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    private ?string $name = null;

    #[MediaConstraint(
        allowedTypes: ['image'],
    )]
    #[MediaDeleteBehavior(strategy: Strategy::RESTRICT)]
    #[ORM\Column(type: MediaTypes::MEDIA, nullable: true)]
    #[Assert\NotBlank()]
    private ?Media $cover = null;

    /**
     * @var Collection<int, Media
     */
    #[ORM\OneToMany(targetEntity: GameVideo::class, mappedBy: 'game', cascade: ['persist'], orphanRemoval: true)]
    private Collection $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCover(): ?Media
    {
        return $this->cover;
    }

    public function setCover(?Media $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function addVideo(GameVideo $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->game = $this;
        }

        return $this;
    }

    public function removeVideo(GameVideo $video): static
    {
        // set the owning side to null (unless already changed)
        if ($this->videos->removeElement($video) && $video->game === $this) {
            $video->game = null;
        }

        return $this;
    }

    public function getVideos(): Collection
    {
        return $this->videos;
    }
}
