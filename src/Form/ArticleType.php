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

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // building of the form with restraints, labels and placeholders
        $builder
            ->add('title', TextType::class,
            [
                'label' => "Titre de l'article",
                'attr' => [
                    'placeholder' => "saisissez le titre de l'article"
                ]
            ])
            ->add('summary', TextareaType::class,
            [
                'label' => "Résumé de l'article",
                'attr' => [
                    'placeholder' => "saisissez le résumé de l'article"
                ]
            ])
            ->add('content', TextareaType::class,
            [
                'label' => "Contenu de l'article",
                'attr' => [
                    'placeholder' => "saisissez le contenu de l'article"
                ]
            
            ])
            ->add('image', TextType::class,
            [
                'label' => "Lien vers l'image",
                'attr' => [
                    'placeholder' => "saisissez le lien de l'image"
                ]
            ])
            ->add('image_description', TextType::class,
            [
                'label' => "Description de l'image",
                'attr' => [
                    'placeholder' => "Décrivez l'image en quelques mots"
                ]
            ])
            ->add('themes', EntityType::class,
            [
                // the entity linked to Article is Theme
                'class' => Theme::class,
                // property used for display
                'choice_label' => 'name',
                // multiple true and expanded true for the chosen display
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
