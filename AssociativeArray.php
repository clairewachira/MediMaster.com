<?php
$age = array("Jack"=>"4", "Lynsey"=>"5");
print_r ($age);
echo "<br/>";

foreach($age as $key=> $value){
    echo "My name is:" .$key. "and age is :" .$value;
    echo "<br/>";
}
?>