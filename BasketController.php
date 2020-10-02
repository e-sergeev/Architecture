<?php

declare(strict_types = 1);

namespace Controller;

use Framework\BaseController;
use Symfony\Component\HttpFoundation\Response;

class BasketController extends BaseController
{
    /**
     * Главная страница
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('basket/main.php');
    }

    public function addAction(): Void
    {
        //метод увеличения единицы товра
    }

    public function deleteAction(): Void
    {
        //метод удаления единицы товара
    }

    
    public function removeAction(): Void
    {
        //Метод удаления товара
    }

        
    public function clearAction(): Void
    {
        //Метод очистки корзины
    }

}
