<?php

namespace App\Form;

use App\Entity\Commentaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentaireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('autheur', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'commentaire-input',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'commentaire-input',
                    'placeholder' => 'E-mail'
                ]
            ])
            ->add('message', TextareaType::class, [
                'row_attr' => ['class' => 'textarea-group'],
                'label' => false,
                'attr' => [
                    'class' => 'commentaire-textarea',
                    'placeholder' => 'Votre commentaire...'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'row_attr' => ['class' => 'commentaire-btn-box'],
                'label' => 'Envoyer',
                'attr' => ['class' => 'commentaire-btn']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
