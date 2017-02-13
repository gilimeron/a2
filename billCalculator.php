<?php
require('../tools.php');

if($_POST) {
    $_POST = sanitize($_POST);


$dividedBill = $_POST['billSum']/$_POST['pplCount'];

if(isset($_POST['roundUp'])) {
     $dividedBill = ceil($dividedBill);
}

}
