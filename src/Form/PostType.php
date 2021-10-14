<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'autofocus' => true,
                    'class' => 'form-control-sm'
                ],
                'label' => 'label.title',
            ])
            ->add('type', TextType::class, [
                'attr' => [
                    'class' => 'form-control-sm'
                ],
                'label' => 'label.type',
            ])
            ->add('summary', TextareaType::class, [
                'label' => 'label.summary',
                'attr' => [
                    'rows' => 4,
                    'class' => 'form-control-sm'
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'label.content',
                'attr' => [
                    'rows' => 15
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => 'label.slug',
                'attr' => [
                    'class' => 'form-control-sm'
                ]
            ])
            ->add('createdAt', DateTimeType::class, [
                'label' => 'label.created_at'
            ])
            ->add('updatedAt', DateTimeType::class, [
                'label' => 'label.updated_at'
            ])
            ->add('tags', null, [
                'label' => 'label.tags',
                'attr' => [
                    'class' => 'form-control-sm'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
