<?php
require('tools.php');

if($_GET) {
    $_GET = sanitize($_GET);


$dividedBill = $_GET['billSum']/$_GET['pplCount'];

if(isset($_GET['roundUp'])) {
     $dividedBill = ceil($dividedBill);
}

}
