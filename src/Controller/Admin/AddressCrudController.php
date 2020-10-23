<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Адреса')
            ->setPageTitle(Crud::PAGE_NEW, 'Добавить адрес')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить адрес')
            ->setEntityLabelInSingular('Адрес')
            ->setEntityLabelInPlural('Адреса')
            ->setSearchFields(['id', 'region', 'city', 'street'])->showEntityActionsAsDropdown();
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Добавить адрес');
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
                return $action->setLabel('Вернуться к списку адресов');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setLabel('Изменить');
            });
    }

    public function configureFields(string $pageName): iterable
    {
        yield IntegerField::new('id', 'ID')->hideOnForm();
        yield TextField::new('region', 'Регион')->setMaxLength(255);
        yield TextField::new('city', 'Город')->setMaxLength(150);
        yield TextField::new('street', 'Улица')->setMaxLength(150);
        yield TextField::new('build', 'Дом')->setMaxLength(10);
        yield TextField::new('part', 'Строение')->setMaxLength(10);
        yield TextField::new('office', 'Квартира/Офис')->setMaxLength(10);
    }
}
