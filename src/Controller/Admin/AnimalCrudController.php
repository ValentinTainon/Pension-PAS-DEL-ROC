<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {    
        yield TextField::new('nom');
        yield TextField::new('type');
        yield TextField::new('sexe');
        yield TextField::new('race');
        yield TextField::new('age');
        yield NumberField::new('poids');
        yield TextField::new('numPuce', 'N° de puce');
        yield BooleanField::new('sterilisation', 'Stérilisé ?');
        yield BooleanField::new('medical', 'Traitement médical ?');
        yield TextareaField::new('infoSup', 'Informations supplémentaires');
    }
}
