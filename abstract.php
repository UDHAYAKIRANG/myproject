<?php

    abstract class A{
        abstract function car();
        function bike(){
            echo "bike is running";
        }
    }
    class B extends A{
        function car(){
            echo "car is running";
        }
    }
    $object=new B();
    $object->car();
    $object->bike();
?>