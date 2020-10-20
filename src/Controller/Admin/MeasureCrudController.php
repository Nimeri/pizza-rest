<?php

namespace App\Controller\Admin;

use App\Entity\Measure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MeasureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Measure::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
