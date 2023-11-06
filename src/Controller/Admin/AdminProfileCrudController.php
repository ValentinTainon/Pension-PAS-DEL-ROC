<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use Symfony\Component\Validator\Constraints\Regex;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use Symfony\Component\Validator\Constraints\Length;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdminProfileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle(Crud::PAGE_INDEX, 'Administrateur')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier mon profil')
            ->showEntityActionsInlined();
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        return parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters)
            ->where('entity.id LIKE :userId')->setParameter('userId', $this->getUser()->getId());
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::SAVE_AND_CONTINUE, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::EDIT, fn (Action $action) => $action->setLabel('Modifier'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('prenom', 'Prénom')->setRequired(true);
        yield TextField::new('email', 'Adresse e-mail');
        yield ChoiceField::new('roles')
            ->setLabel('Rôle')
            ->setChoices(['ADMINISTRATEUR' => 'ROLE_ADMIN'])
            ->allowMultipleChoices(true)
            ->setRequired(false)
            ->setDisabled();
        yield TextField::new('password')
            ->onlyWhenUpdating()
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Nouveau mot de passe', 'hash_property_path' => 'password'],
                'second_options' => ['label' => 'Répéter le nouveau mot de passe'],
                'mapped' => false,
                'constraints' => [
                    new Length(['max' => 4096]), // max length allowed by Symfony for security reasons
                    new Regex([
                        'pattern' => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&.*-]).{8,}$/',
                        'message' => 'Votre mot de passe doit contenir au minimum 8 caractères avec au moins une lettre majuscule,
                        une lettre minuscule, un chiffre et un caractère spécial.'
                    ]),
                ],
            ])
            ->setRequired(false);
    }
}
