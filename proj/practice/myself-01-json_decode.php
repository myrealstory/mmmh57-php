
     <?php

        header('Content-Type: text/plain');

        class Person
        {

            static $count = 0;

            public $mobile;
            var $name;
            private $sno = 'secret';

            function _construct($name = '', $mobile = '')
            {
                Person::$count++;
                $this->name = $name;
                $this->mobile = $mobile;
            }

            static function count()
            {
                return Person::$count;
            }
        }
        $p1 = new Person;
        $p1->name = "Carl";
        $p1->moblie = "0918-123-456";

        echo "{$p1->mobile}\n";

        $p2 = new Person('John', '0918-22233355');
        var_dump($p2);

        // Person::count();
        $p3 = new Person();
        echo "共有" . Person::count() . "人\n";

        ?>