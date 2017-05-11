<?php 
     @$users= $_POST['users'];
if( is_array($users)){
while (list ($key, $val) = each ($users)) {
echo "$val <br>";

}
}

?> 