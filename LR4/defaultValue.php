<?php
function getValuesFromPost() {
    $defaultValue = '';

    if (isset($_POST['textarea'])) {
        $defaultValue = $_POST['textarea'];
    }

    return $defaultValue;
}