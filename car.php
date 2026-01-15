<?php
require "header.php"; 

class Car{ 
    public string $make;
    public string $model;
    public int $year;

    public function __construct(string $make, string $model, int $year){
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }


    public function getCarInfo(): string {
        return "Car: " . $this->year . " " . $this->make . " " . $this->model;
    }
/* I found the creating of the class method and building the constructor most challenging, figuring out 
what keyword $this does and how to properly use it in a method */
        
}

    $car1 = new Car("Toyota", "Camry", 2020);

         echo $car1->getCarInfo();     
         
         require "footer.php"; 