<?php

include "test.php";
exit;
class BB {
    private $name;

    protected function setName($name) { $this->name = $name;}
    public function tell() {echo "i want to tell";}
}
$s = serialize(new BB);
var_dump($s);
var_dump(unserialize($s));

?>

<!DOCTYPE html>
<html>
<body>

<p>This example uses the addEventListener() method to attach a click event to a button.</p>

<button id="myBtn" class="btn">Try it</button>

<script>
//    document.getElementById("myBtn").addEventListener("click", function(){
//        alert("Hello World!");
//
//    });

    document.getElementById('myBtn').addEventListener("click", myFunc);

    document.getElementsByClassName('btn    ').addEventListener("click", myFunc);


    function myFunc()
    {
        alert("fuck everyone!");
    }
</script>

</body>
</html>
