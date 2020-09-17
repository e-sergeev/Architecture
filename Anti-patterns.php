<?

### Метод toArray можно заменить на (array)$object когда понадобится массив. Получается изобрели колесо.
### Дополнительно в методе жестко прописаны свойства и каждый раз, когда будут появляться новый свойства, нужно не забывать про метод. Это что-то типа харбкода.

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
        ];
    }

### Два одинаковых класса, можно сделать один или класс-роидтель и наследоваться от него с добавлением номера телефона или почтового адреса.Copy-paste

class Email implements CommunicationInterface
{
    /**
     * @inheritdoc
     */
    public function process(
        User $user,
        string $templateName,
        array $params = []
    ): void {
        // Вызываем метод по формированию тела письма и последующей отправки
    }
}

class Sms implements CommunicationInterface
{
    /**
     * @inheritdoc
     */
    public function process(
        User $user,
        string $templateName,
        array $params = []
    ): void {
        // Вызываем метод по формированию смс текста и последующей отправки
    }
}

### Что-то типа кодирования. Хорошо бы было описать этот process

    public function process(
        User $user,
        string $templateName,
        array $params = []
    ): void;

### Дискаунт жестко прописан. Можно было бы брать из бд промо кодов 

    public function getDiscount(): float
    {
        // Получаем по промокоду размер скидки на заказ в процентах
        // $discount = $this->find($this->promoCode)->discount();
        $discount = 5.50;

        // Запрос в систему хранения промокодов для пометки данного кода как
        // использованный
        // $this->find($this->promoCode)->deactivate();

        return $discount;
    }

### Божественный объект. Калькуляции и заказ можно было реализовать другими классами.

class Basket
{
    /**
     * Сессионный ключ списка всех продуктов корзины
     */
    private const BASKET_DATA_KEY = 'basket';

    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Добавляем товар в заказ
     * @param int $productId
     * @return void
     */
    public function addProduct(int $productId): void
    {
        $basket = $this->session->get(static::BASKET_DATA_KEY, []);
        if (!in_array($productId, $basket, true)) {
            $basket[] = $productId;
            $this->session->set(static::BASKET_DATA_KEY, $basket);
        }
    }

    /**
     * Проверяем, лежит ли продукт в корзине или нет
     * @param int $productId
     * @return bool
     */
    public function isProductInBasket(int $productId): bool
    {
        return in_array($productId, $this->getProductIds(), true);
    }

    /**
     * Получаем информацию по всем продуктам в корзине
     * @return Product[]
     */
    public function getProductsInfo(): array
    {
        $productIds = $this->getProductIds();
        return $this->getProductRepository()->search($productIds);
    }

    /**
     * @return float
     */
    public function calculateProductsTotalPrice(): float
    {
        $totalPrice = 0;
        foreach ($this->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }
        return $totalPrice;
    }

    /**
     * Оформление заказа
     * @return void
     * @throws BillingException
     * @throws CommunicationException
     */
    public function checkout(): void
    {
        // Здесь должна быть некоторая логика выбора способа платежа
        $billing = new Card();

        // Здесь должна быть некоторая логика получения информации о скидке
        // пользователя
        $discount = new NullObject();

        // Здесь должна быть некоторая логика получения способа уведомления
        // пользователя о покупке
        $communication = new Email();

        $security = new Security($this->session);

        $this->checkoutProcess($discount, $billing, $security, $communication);
    }

    /**
     * Проведение всех этапов заказа
     * @param DiscountInterface $discount
     * @param BillingInterface $billing
     * @param SecurityInterface $security
     * @param CommunicationInterface $communication
     * @return void
     * @throws BillingException
     * @throws CommunicationException
     */
    public function checkoutProcess(
        DiscountInterface $discount,
        BillingInterface $billing,
        SecurityInterface $security,
        CommunicationInterface $communication
    ): void {
        $totalPrice = 0;
        foreach ($this->getProductsInfo() as $product) {
            $totalPrice += $product->getPrice();
        }

        $discount = $discount->getDiscount();
        $totalPrice = $totalPrice - $totalPrice / 100 * $discount;

        $billing->pay($totalPrice);

        $user = $security->getUser();
        $communication->process($user, 'checkout_template');
    }

    /**
     * Фабричный метод для репозитория Product
     * @return ProductRepository
     */
    protected function getProductRepository(): ProductRepository
    {
        return new ProductRepository();
    }

    /**
     * Получаем список id товаров корзины
     * @return array
     */
    private function getProductIds(): array
    {
        return $this->session->get(static::BASKET_DATA_KEY, []);
    }
}

