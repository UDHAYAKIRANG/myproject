<?php

    namespace A{
        abstract class car{
            public $name="udhayakiran";
            abstract function car();
        }
    }
    namespace B{
        abstract class car{
            protected $name="moorthy";
            private function account($accNo){
                echo "Account holder Name: ".$this->name."\n";
                echo "Account number: ".$accNo."\n";
            }
            function __construct($accNo){
                $this->account($accNo);
            }
            abstract function car();
        }
    }
    namespace{
    class C extends A\car{
        function car(){
            echo "car is running"."\n";
        }
        function __construct($accNo){
            echo "Account holder Name: ".$this->name."\n";
            echo "Account Number: ".$accNo."\n";
        }
    }
    class D extends B\car{
        function car(){
            echo "bike is running";
        }
    }
    $object=new C(1817);
    // $object->car();
    $object1=new D(1818);
    // $object1->car();
        echo "hello";
    }
?>