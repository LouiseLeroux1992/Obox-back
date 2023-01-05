<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Theme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // building of the form with restraints, labels and placeholders
        $builder
            ->add('name', TextType::class,
            [
                'label' => "Nom du thème",
                'attr' => [
                    'placeholder' => "Saisissez le nom du thème"
                ]
            ])
            ->add('description', TextareaType::class,
            [
                'label' => "Description du thème",
                'attr' => [
                    'placeholder' => "Décrivez le thème"
                ]
            ])
            ->add('image', TextType::class,
            [
                'label' => "Lien vers l'image",
                'attr' => [
                    'placeholder' => "Saisissez le lien de l'image"
                ]
            
            ])
            ->add('image_description', TextType::class,
            [
                'label' => "Description de l'image",
                'attr' => [
                    'placeholder' => "Décrivez l'image en quelques mots"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Theme::class,
        ]);
    }
}
