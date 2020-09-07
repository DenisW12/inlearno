<?php

declare(strict_types=1);

require_once '../bootstrap.php';

use Src\Bike;

$bike = new Bike();
$bike->turnPedals();
$bike->speedUp();
$bike->turnWheelToLeft(10);
$bike->turnWheelToCenter();
$bike->speedUp();
$bike->speedUp();
$bike->speedDown();
$bike->speedDown();
$bike->turnWheelToRight(20);
$bike->turnWheelToCenter();
$bike->stop();