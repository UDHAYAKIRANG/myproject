<?php

    class A{
        private function hello(){
            echo "hello";
        }
        public $name="udhayakiran";
        protected $name1="karthikeyan"."\n";
        function __construct($variable){
            $this->hello();
            echo $variable;
        }
        protected function car(){
            echo "car is running"."\n";
        }
    }
    class B extends A{
        function __construct($variable){
            $this->car();
            echo $this->name1;
            parent::__construct($variable);
        }
    }
    $object=new B(198);
    echo $object->name;
?>