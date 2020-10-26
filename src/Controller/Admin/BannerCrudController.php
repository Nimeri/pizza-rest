<?php

namespace App\Controller\Admin;

use App\Entity\Banner;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class BannerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Banner::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Баннры')
            ->setPageTitle(Crud::PAGE_NEW, 'Добавить баннер')
            ->setPageTitle(Crud::PAGE_EDIT, 'Изменить баннер')
            ->setEntityLabelInSingular('Баннер')
            ->setEntityLabelInPlural('Баннеры')
            ->showEntityActionsAsDropdown()
            ->setSearchFields(['id', 'name']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Добавить баннер');
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
                return $action->setLabel('Вернуться к списку');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setLabel('Изменить');
            });
    }

    public function configureFields(string $pageName): iterable
    {

        yield IntegerField::new('id', 'ID')->hideOnForm();
        yield DateTimeField::new('createdAt', 'Дата  создания')->hideOnForm();
        yield BooleanField::new('active', 'Активность');
        yield TextField::new('name', 'Название');
        yield TextField::new('link', 'Ссылка')->hideOnIndex();
        yield IntegerField::new('position', 'Позиция');
        yield ImageField::new('image', 'Изображение')->onlyOnIndex()
            ->setBasePath('/uploads/images/banners');
        yield ImageField::new('imageFile', 'Изображение')
            ->setFormType(VichImageType::class)
            ->onlyOnForms();
    }
}
