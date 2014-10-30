<?php
error_reporting(-1);
ini_set('display_errors', 'On');

class Pound
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}


class Weight
{
    public $pound;

    public function __construct($pound)
    {
        $this->pound = $pound;
    }
}

class Foot
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

class Height
{
    public $foot;

    public function __construct($foot)
    {
        $this->foot = $foot;
    }
}

class BMICalculator
{

    public $weight;
    public $height;

    public function setWeight($weight)
    {
        $this->weight = $weight->pound->value;
        return $this;
    }

    public function setHeight($height)
    {
        $this->height = $height->foot->value;
        return $this;
    }

    public function getResultAsExtendedClassification()
    {

        //BMI=masa(kg)/wzrost(m)2
        //kg = lb x 0.45359237
        //m = feet x 0.3048

        $w_pound = $this->weight;
        $h_foot = $this->height;

        $w = $w_pound * 0.45359237;
        $h = $h_foot * 0.3048;

        $bmi = $w / (pow($h, 2));
        return $bmi;
    }
}

$BMICalc = new BMICalculator();

$result = $BMICalc
    ->setWeight(new Weight(new Pound(100)))
    ->setHeight(new Height(new Foot(200)))
    ->getResultAsExtendedClassification();

echo sprintf('Result: "%s"', $result);

