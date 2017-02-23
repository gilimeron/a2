<?php
require('Form.php');

$form = new Bill\Form($_GET);

$errors = [];

if($form->isSubmitted()) {
    # values
    $pplCount = $form->get('pplCount','');
    $billSum = $form->get('billSum','');
    $serviceScore = $form->get('serviceScore','');
    $roundUp = $form->isChosen('roundUp');

    # validation
    $errors = $form->validate(
        [
            'pplCount' => 'required|integer|min:1',
            'billSum' => 'required|numeric|min:0',
        ]
    );

    # calculation
    if($roundUp) {
        $dividedBill = ceil($billSum/$pplCount);
    }
    else {
        $dividedBill = number_format(($billSum/$pplCount),2);
    }

}
