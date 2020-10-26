<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;
use App\Entity\Address;
use App\Entity\Banner;
use App\Entity\Measure;
use App\Entity\OrderProducts;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\User;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(CategoryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sole-pizza')
            ->setTranslationDomain('sole-pizza.ru');
    }

    public function configureMenuItems(): iterable
    {
//        yield MenuItem::linktoRoute('Вернуться на сайт', 'fa fa-home', 'homepage');
        yield MenuItem::subMenu('Пользователи', 'fa fa-address-card')->setSubItems([
            MenuItem::linkToCrud('Пользователи', 'fa fa-user', User::class),
            MenuItem::linkToCrud('Адреса', 'fa fa-map-marked-alt', Address::class),
        ]);
        yield MenuItem::subMenu('Каталог', 'fa fa-cookie-bite')->setSubItems([
            MenuItem::linkToCrud('Категории', 'fa fa-tags', Category::class),
            MenuItem::linkToCrud('Товары', 'fa fa-pizza-slice', Product::class),
        ]);
        yield MenuItem::linkToCrud('Заказы', 'fa fa-shopping-basket', Orders::class);
        yield MenuItem::linkToCrud('Баннеры', 'fa fa-photo-video', Banner::class);
        yield MenuItem::linkToCrud('Единицы измерения', 'fa fa-ruler-combined', Measure::class);

    }
}
