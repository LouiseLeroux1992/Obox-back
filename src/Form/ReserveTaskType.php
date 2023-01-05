<?php

namespace App\Form;

use App\Entity\ReserveTask;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReserveTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => "Nom de la tâche",
                'attr' => [
                    'placeholder' => "saisissez lnom de la tâche"
                ]
            ])
            ->add('tag', EntityType::class,
            [
                // the entity linked to ReserveTask is Tag
                'class' => Tag::class,
                // property used for display
                'choice_label' => "name",
                // multiple false and  expanded false for the chosen display
                'multiple' => false,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReserveTask::class,
        ]);
    }
}
