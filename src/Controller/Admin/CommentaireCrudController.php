<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['dateCreation' => 'DESC'])
            ->setEntityLabelInPlural('Commentaires')
            ->showEntityActionsInlined()
            ->setPageTitle(Crud::PAGE_EDIT, 'Validation');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->disable(Action::NEW, Action::SAVE_AND_CONTINUE)
            ->update(Crud::PAGE_INDEX, Action::EDIT, fn (Action $action) => $action->setLabel('Validation'))
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, fn (Action $action) => $action->setLabel('Enregistrer'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield DateTimeField::new('dateCreation', 'Date de publication')->setDisabled()->setRequired(false);
        yield TextField::new('autheur', 'Autheur')->setDisabled()->setRequired(false);
        yield TextareaField::new('message', 'Message')->onlyOnForms()->setDisabled()->setRequired(false);
        yield BooleanField::new('isValidated', 'Validé / Non validé')->setDisabled($pageName === Crud::PAGE_INDEX);
    }
}
