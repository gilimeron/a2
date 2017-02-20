<?php
require('Form.php');

$form = new DWA\Form($_GET);

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
            'pplCount' => 'required|numeric|min:1',
            'billSum' => 'required|numeric|min:1',
        ]
    );


        $dividedBill = $billSum/$pplCount;
        if($roundUp) {
             $dividedBill = ceil($dividedBill);
        }

}
