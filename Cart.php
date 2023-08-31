<?php

class Cart implements iCartInterface
{
    public array $items;
    public object $order;

    /**
     * @return float|int
     */
    public function calcVat(): float|int
    {
        return $this->calcPrice(0.18);
    }

    /**
     * @return void
     */
    public function notify(): void
    {
        $price = $this->calcPrice();
        $this->sendMail($price);
    }

    /**
     * @param float|int $discount
     * @return void
     */
    public function makeOrder(float|int $discount = 1.0): void
    {
        $price = $this->calcPrice() * $discount;
        $this->order = new Order($this->items, $price);
        $this->notify();
    }

    /**
     * @param float|int $price
     * @return void
     */
    public function sendMail(float|int $price): void
    {
        $message = "<p> <b>" . $this->order->id() . "</b> " . $price . " .</p>";

        $mailer = new SimpleMailer('cartuser', 'j049lj-01');
        $mailer->sendToManagers($message);
    }

    /**
     * @param float|int $value
     * @return float|int
     */
    public function calcPrice(float|int $value = 1.18): float|int
    {
        $price = 0;
        foreach ($this->items as $item) {
            $price += $item->getPrice() * $value;
        }
        return $price;
    }
}
