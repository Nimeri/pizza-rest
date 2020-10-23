<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Категории')
            ->setPageTitle(Crud::PAGE_NEW, 'Добавить категорию')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить категорию')
            ->setEntityLabelInSingular('Категория')
            ->setEntityLabelInPlural('Категории')
            ->setSearchFields(['id', 'name'])->showEntityActionsAsDropdown();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Добавить категорию');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Изменить');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Удалить');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Сохранить и вернуться к списку');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel('Сохранить и добавить еще');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Сохранить и вернуться к списку');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel('Сохранить');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setLabel('Удалить');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setLabel('Вернуться к списку категорий');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setLabel('Изменить');
            })
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IntegerField::new('id', 'ID')->hideOnForm();
        yield DateTimeField::new('createdAt', 'Дата создания')->hideOnForm();
        yield BooleanField::new('active', 'Активность');
        yield TextField::new('name', 'Название');
        yield TextField::new('code', 'Символьный код')->onlyOnIndex();
        yield ImageField::new('image', 'Изображение')->onlyOnIndex()
            ->setBasePath('/uploads/images/category');
        yield ImageField::new('imageFile', 'Изображение')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
        yield TextareaField::new('description', 'Описание')->hideOnIndex();
        yield AssociationField::new('parentCategory', 'Родительская категория');
//        $productsCount = AssociationField::new('productsCount');
    }
}
