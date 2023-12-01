<?php
function getValuesFromPost() {
    $defaultValue = '';

    if (isset($_POST['text'])) {
        $defaultValue = $_POST['text'];
    }

    return $defaultValue;
}