<?php

declare(strict_types=1);

namespace Src;


final class Bike
{

    /**
     * Угол поворота переднего колеса
     *
     * @var int
     */
    private int $frontWheelRotationAngle = 0;

    /**
     * Колеса крутятся или нет
     *
     * @var bool
     */
    private bool $isWheelsTurning = false;

    /**
     * Текущая скорость
     *
     * @var int
     */
    private int $currentSpeed = 1;

    /**
     * Скоростей
     */
    private const MAX_SPEEDS = 5;

    /**
     * Повернуть руль влево
     *
     * @param int $angle
     */
    public function turnWheelToLeft(int $angle): void
    {
        $this->frontWheelRotationAngle -= $angle;
        $this->validateAngle();
        echo 'Вы повернули левее на ' . $angle . ' градусов<br>';
    }

    /**
     * Повернуть руль вправо
     *
     * @param int $angle Угол поворота
     */
    public function turnWheelToRight(int $angle): void
    {
        $this->frontWheelRotationAngle += $angle;
        $this->validateAngle();
        echo 'Вы повернули правее на ' . $angle . ' градусов<br>';
    }

    /**
     * Выровнять руль
     */
    public function turnWheelToCenter(): void
    {
        $this->frontWheelRotationAngle = 0;
        echo 'Вы выровняли колоса<br>';
    }

    /**
     * Крутить педали
     */
    public function turnPedals(): void
    {
        echo 'Велосипед движется<br>';
        $this->isWheelsTurning = true;
    }

    /**
     * Нажимаем на тормоз
     */
    public function stop(): void
    {
        echo 'Велосипед остановился<br>';
        $this->isWheelsTurning = false;
    }

    /**
     * Переключение передач вверх
     */
    public function speedUp(): void
    {
        if ($this->currentSpeed == self::MAX_SPEEDS) {
            echo 'У вас уже максимальная скорость<br>';
        } else {
            $this->currentSpeed++;
            echo 'Текущая скорость ' . $this->currentSpeed . '<br>';
        }
    }

    /**
     * Переключение передач вниз
     */
    public function speedDown(): void
    {
        if ($this->currentSpeed == 1) {
            echo 'У вас уже минимальная скорость<br>';
        } else {
            $this->currentSpeed--;
            echo 'Текущая скорость ' . $this->currentSpeed . '<br>';
        }
    }

    /**
     * Проверяем, чтобы сильно не вывернули руль и не упали
     */
    private function validateAngle(): void
    {
        if (abs($this->frontWheelRotationAngle) > 30) {
            throw new \DomainException('Вы слишком резко дернули руль и упали');
        }
    }
}