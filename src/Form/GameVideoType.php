<?php

namespace App\Form;

use App\Entity\GameVideo;
use JoliCode\MediaBundle\Bridge\Sylius\Admin\Form\Type\MediaChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameVideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('media', MediaChoiceType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GameVideo::class,
        ]);
    }
}
