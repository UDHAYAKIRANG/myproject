<?php

    interface A{
        public function car();
    }
    class B implements A{
        public function car(){
            echo "car is running";
        }
    }
    $object=new B();
    $object->car();
?>