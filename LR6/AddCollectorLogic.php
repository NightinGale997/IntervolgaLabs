<?php
require_once "TableModule.php";
require_once "ImageHelper.php";
TableModule::DatabaseConnect();
if(empty(TableModule::Validate($_POST['CollectorName'],$_POST['CollectorDescription'],$_POST['CollectorBirthDate'],$_FILES['CollectorImage'],$_POST['CollectorTeam']))){
    if(!empty($_FILES['CollectorImage'])){
        $NewPhotoPath = ImageHelper::RenameUserPhoto($_FILES['CollectorImage']);
        $successMessage = TableModule::CreateCollector($NewPhotoPath,$_POST['CollectorName'],$_POST['CollectorTeam'],$_POST['CollectorDescription'],$_POST['CollectorBirthDate']);
        if(!empty($successMessage)){
            $success_message = "Сборщик успешно добавлен";
            header("Location: index.php?message=" . htmlspecialchars($success_message));
            exit();
        }
    }
}