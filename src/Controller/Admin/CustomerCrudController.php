<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setPageTitle(Crud::PAGE_INDEX, 'Clients')
            ->setPageTitle(Crud::PAGE_EDIT, 'Détails client')
            ->showEntityActionsInlined();
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        $queryBuilder->where('entity.roles NOT LIKE :role')->setParameter('role', '%' . 'ROLE_ADMIN' . '%');

        return $queryBuilder;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::SAVE_AND_CONTINUE, Action::SAVE_AND_RETURN)
                    ->update(Crud::PAGE_INDEX, Action::EDIT, fn (Action $action) => $action->setLabel('Détails'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom')->setDisabled();
        yield TextField::new('prenom', 'Prénom')->setDisabled();
        yield TextField::new('adresse')->onlyWhenUpdating()->setDisabled();
        yield TextField::new('codePostal')->onlyWhenUpdating()->setDisabled();
        yield TextField::new('ville')->onlyWhenUpdating()->setDisabled();
        yield TextField::new('email')->setDisabled()->setRequired(false);
        yield TextField::new('telephone', 'Téléphone')->onlyWhenUpdating()->setDisabled();
        yield CollectionField::new('animals')->useEntryCrudForm(AnimalCrudController::class)->setDisabled();
    }
}