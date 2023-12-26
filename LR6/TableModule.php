<?php

class TableModule{
    private static $pdo;

    public static $errors = [];
    public static function DatabaseConnect()
    {
        self::$pdo = new PDO("mysql:host=localhost;dbname=seven_semen", 'root');
    }


    public static function GetCollectors(){
        self::DatabaseConnect();
        $sql = "SELECT * FROM collectors INNER JOIN teams ON collectors.id_team = teams.id ";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll();
    }

    public static function GetTeams(){
        self::DatabaseConnect();
        $sql ="SELECT * FROM teams";
        $stmt = self::$pdo->query($sql);
        return $stmt->fetchAll();
    }
    public static function Validate($collectorName, $collectorDescription, $collectorBirthDate, $collectorImgPath, $collectorTeam){
        if (empty($collectorName)||empty($collectorTeam) ||empty($collectorBirthDate) || empty($collectorImgPath['tmp_name']) || empty($collectorDescription)){
            self::$errors[] = "Не все поля заполнены";
            return self::$errors;
        }

        if((int)$collectorBirthDate != $collectorBirthDate || $collectorBirthDate < 1900 || $collectorBirthDate > 2023){
            self::$errors[] = "Год рождения должен быть целым числом";
        }
        if(exif_imagetype($collectorImgPath['tmp_name']) === false){
            self::$errors[] = "Файл не является фото";
        }
        return self::$errors;
    }

    public static function CreateCollector($newPhotoPath, $productName, $productDiscount, $productDescription, $productCost){
        $sql =  "INSERT INTO collectors (img_path,name,id_team,personal_description,birth_date) VALUES (:img_path,:name,:id_team,:personal_description,:birth_date)";
        $stmt = self::$pdo->prepare($sql);
        $params = [
            'img_path' => $newPhotoPath,
            'name' => $productName,
            'id_team' => $productDiscount,
            'personal_description' => $productDescription,
            'birth_date' => $productCost
        ];
        $productAdded = $stmt->execute($params);
        return $productAdded ?  "Сборщик был добавлен" : "";
    }
}