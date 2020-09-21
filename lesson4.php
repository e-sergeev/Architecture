<?php

# Задание 1
# Насколько я понимаю, BaseController - фабрика, которая создает различные объекты для использования в контроллерах, render, например

class MainController extends BaseController
{
    /**
     * Главная страница
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('main/index.html.php');
    }
}

# Задание 2

public function search(array $ids = []): array
{
    if (!count($ids)) {
        return [];
    }

    $productList = [];
    $product = new Product(0, '', 0);
    foreach ($this->getDataFromSource(['id' => $ids]) as $item) {
        $productItem = clone $product;
        $productItem->id = $item['id'];
        $productItem->name= $item['name'];
        $productItem->price = $item['price'];
        $productList[] = clone $productItem;
    }

    return $productList;
}


# Задание 3

//Необходимо создать интерфейс для строителя с необходимыми методами

use Service\Discount\NullObject;
use Service\Billing\Transfer\Card;
use Service\Communication\Sender\Email;

interface BasketBuilderInterface {

    public function getCard():Card


    public function getNullObject():NullObject

 
    public function getEmail():Email

}


//Создать класс строителя с методами

class BasketBuilder implements BasketBuilderInterface {


    public function getCard():Card 
    {
        //возвращает объект
    }


    public function getNullObject():NullObject

    {
        //возвращает объект
    }
 
    public function getEmail():Email
    {
        //возвращает объект
    }

}


//Метод, который использует строителя
public function checkout(): void
{
    $builder = new BasketBuilder();

    $this->checkoutProcess(
        $builder->getNullObject(), 
        $builder->getCard(), 
        $builder->getSecurity($this->session), 
        $communication
    );
}

