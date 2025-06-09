<?php

    trait A{
        function car(){
            echo "car is running";
        }
    }
    trait B{
        function bike(){
            echo "bike is running";
        }
    }
    class C{
        use A,B;
        function bike(){
            echo "dog is barking";
            $this->name;
        }
    }
    $obj=new C();
    $obj->bike();
    // $obj->car();-
    // $obj->dog();
    echo "virat";
?>