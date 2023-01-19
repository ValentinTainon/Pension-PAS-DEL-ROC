<?php

namespace App\Form;

use App\Form\UserType;
use App\Form\AnimalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', UserType::class, ['label' => false])
            ->add('animal', AnimalType::class, ['label' => false])
            ->add('dateDebut', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'label' => 'Date et heure d\'arrivée*',
                'attr' => ['class' => 'form-input datepicker']])
            ->add('dateFin', TextType::class, [
                'row_attr' => ['class' => 'input-group'],
                'label' => 'Date et heure de départ*',
                'attr' => ['class' => 'datepicker']])
            ->add('submit', SubmitType::class,[
                'label' => 'Réserver',
                'attr' => ['class' => 'btn']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'validation_groups' => 'reservation',
        ]);
    }
}
