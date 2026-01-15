
<?php
require "header.php"; 
//student id 200344355
//Chris Hagan

class Car{ 
    /*creating variable instances*/ 
    public string $make;
    public string $model;
    public int $year;

    /*class constructor with three parameters */
    public function __construct(string $make, string $model, int $year){
        /*assign object properties to current instance */
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    /*method to return car information as a string */
    public function getCarInfo(): string {
        /*return  current instance  */   
        return "Car: " . $this->year . " " . $this->make . " " . $this->model;
    }
/* I found the creating of the class method and building the constructor most challenging, figuring out 
what keyword $this does and how to properly use it in a method */
        
}
    /*create a new Car object by instantiating */
    $car1 = new Car("Toyota", "Camry", 2020);

         echo $car1->getCarInfo();     
         
         require "footer.php"; 
