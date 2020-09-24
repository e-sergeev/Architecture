<?php

use Service\Order\Basket;

class CheckoutFacade {

    /**
     * @var Basket
     */

    private $basket;


    /**
     * @param Basket $basket
     */

    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
    }

    public function checkout():void {

        $this->basket->checkout();

    }
}