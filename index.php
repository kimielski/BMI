<?php
error_reporting(-1);
ini_set('display_errors', 'On');
header('Content-Type: text/html; charset=utf-8');

class Pound
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

class Kilogram
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
    public $kilogram;


    public function __construct($myweight)
    {
        $this->pound = $myweight;
        $this->kilogram = $myweight;
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

class Meter
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
    public $meter;

    public function __construct($myheight)
    {
        $this->foot = $myheight;
        $this->meter = $myheight;
    }
}

class BMICalculator
{

    public $weight;
    public $height;

    public function setWeight($weight)
    {
		if ($weight->pound->value) {
			$this->weightpound = $weight->pound->value;
			return $this;
		}
		else {
			$this->weightkg = $weight->kilogram->value;
			return $this;
		}
        
    }

    public function setHeight($height)
    {
		if ($height->foot->value) {
        $this->heightfoot = $height->foot->value;
        return $this;
		}
		else {
			$this->heightmeter = $height->meter->value;
			return $this;
			}
    }

    public function getResultAsExtendedClassification()
    {

        //BMI=masa(kg)/wzrost(m)2
        //kg = lb x 0.45359237
        //m = feet x 0.3048


		if($this->weightpound) {
			$w_pound = $this->weightpound;
			$w = $w_pound * 0.45359237;
		}
		else {
			$w_kg = $this->weightkg;
			$w = $w_kg;
		}
		
		if ($this->heightfoot){
			$h_foot = $this->heightfoot;
			$h = $h_foot * 0.3048;
		}
		else {
			$h_meter = $this->heightmeter;
			$h = $h_meter;
		}


        $bmi = $w / (pow($h, 2));
        $bmi2 = $bmi;
        $bmi = round($bmi,2);

        $bmi < 16.0 ? $bmi = 'wygłodzenie':'';
        $bmi > 16.0 && $bmi < 16.99 ? $bmi = 'wychudzenie (spowodowane często przez ciężką chorobę lub anoreksję)' : '';
        $bmi > 17.0 && $bmi < 18.49 ? $bmi = 'niedowaga' : '';
        $bmi > 18.5 && $bmi < 24.99 ? $bmi = 'wartość prawidłowa' : '';
        $bmi > 25.0 && $bmi < 29.99 ? $bmi = 'nadwaga' : '';
        $bmi > 30.0 && $bmi < 34.99 ? $bmi = 'I stopień otyłości' : '';
        $bmi > 35.0 && $bmi < 39.99 ? $bmi = 'II stopień otyłości (otyłość kliniczna)' : '';
        $bmi >= 40.0 ? $bmi = 'III stopień otyłości (otyłość skrajna)': '';
        return $bmi;
    }
}

$BMICalc = new BMICalculator();

$result = $BMICalc
    ->setWeight(new Weight(new Pound(100)))
    ->setHeight(new Height(new Foot(200)))
    ->getResultAsExtendedClassification();

echo sprintf('Result: "%s"', $result);

echo PHP_EOL;

$result = $BMICalc
    ->setWeight(new Weight(new Kilogram(300)))
    ->setHeight(new Height(new Meter(400)))
    ->getResultAsExtendedClassification();

echo sprintf('Result: "%s"', $result);
