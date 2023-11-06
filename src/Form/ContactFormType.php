<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'row_attr' => ['class' => 'objet'],
                'label' => false,
                'attr' => [
                    'class' => 'contact-input',
                    'placeholder' => 'Nom']])
            ->add('email', EmailType::class, [
                'row_attr' => ['class' => 'objet'],
                'label' => false,
                'attr' => [
                    'class' => 'contact-input',
                    'placeholder' => 'Email']])
            ->add('objet', TextType::class, [
                'row_attr' => ['class' => 'objet'],
                'label' => false,
                'attr' => [
                    'class' => 'contact-input objet',
                    'placeholder' => 'Objet']])
            ->add('message', TextareaType::class, [
                'row_attr' => ['class' => 'textarea-group'],
                'label' => false,
                'attr' => [
                    'class' => 'contact-textarea',
                    'placeholder' => 'Votre message...']])
            ->add('submit', SubmitType::class, [
                'row_attr' => ['class' => 'contact-btn-box'],
                'label' => 'Envoyer',
                'attr' => ['class' => 'contact-btn']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
