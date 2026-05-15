<?php

namespace App\Twig\Component;

use App\Entity\Game;
use App\Form\GameType;
use Sylius\TwigHooks\LiveComponent\HookableLiveComponentTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent(
    name: 'game_form_component',
    template: '@SyliusBootstrapAdminUi/shared/crud/common/content/form.html.twig',
)]
class GameFormComponent extends AbstractController
{
    use LiveCollectionTrait;
    use DefaultActionTrait;
    use HookableLiveComponentTrait;

    #[LiveProp]
    public Game $resource;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(GameType::class, $this->resource);
    }
}
