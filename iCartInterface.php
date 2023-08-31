<?php

interface iCartInterface
{
    /**
     * @return float|int
     */
    public function calcVat(): float|int;

    /**
     * @return void
     */
    public function notify(): void;

    /**
     * @param float|int $discount
     * @return void
     */
    public function makeOrder(float|int $discount): void;
}
