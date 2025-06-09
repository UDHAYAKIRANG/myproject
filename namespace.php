<?php

    namespace A{
        class B{
            function car(){
                echo "car is running";
            }
        }
    }
    namespace B{
        class B{
            function car(){
                echo "hello";
            }
        }
    }
    namespace{
    $object=new A\B();
    $object->car();
    $object1=new B\B();
    $object1->car();
    }
    
?>