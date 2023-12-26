<?php
error_reporting(E_ALL);
require_once "TableModule.php";
$teams = TableModule::GetTeams();
if(isset($_POST['addCollector'])){
    require_once "AddCollectorLogic.php";
}
require_once "layout/header.php";
?>
<h1>Добавить сборщика</h1>
<?php
if (!empty((TableModule::$errors))):
    ?>
    <div class="alert alert-danger" role="alert">
        <ul>
            <?php
            foreach (TableModule::$errors as $error):
                ?>
                <li><?php echo $error; ?></li><?php
            endforeach;
            ?>
        </ul>
    </div>
<?php endif; ?>
<form method="POST" action="AddCollector.php" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <input type="text" class="form-control" placeholder="Имя" name="CollectorName" value ="<?= !empty($_POST['CollectorName']) ? htmlspecialchars($_POST['CollectorName']) : ""?>">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" placeholder="Описание" name="CollectorDescription" value ="<?= !empty($_POST['CollectorDescription']) ? htmlspecialchars($_POST['CollectorDescription'] ) : ""?>">
            </div>
            <div class="col-2">
                <input type="text" class="form-control" placeholder="Год рождения" name="CollectorBirthDate" value ="<?= !empty($_POST['CollectorBirthDate']) ? htmlspecialchars($_POST['CollectorBirthDate'])  : ""?>">
            </div>
            <div class="col-3">
                <input type="file" class="form-control" name="CollectorImage" value ="<?= !empty($_POST['CollectorImage']) ? htmlspecialchars($_POST['CollectorImage']) : ""?>">
            </div>
        </div>
        <div class="col-4 mt-2">
            <select class="form-select" name="CollectorTeam">
                <option value="" selected>Бригада</option>
                <?php
                foreach ($teams as $team):
                    ?>
                    <option value = "<?= $team['id']?>" <?= (isset($_POST['CollectorTeam'])) && $_POST['CollectorTeam'] == $team['id'] ? "selected" : ""  ?> ><?= htmlspecialchars($team['team_name'])?></option>
                <?php endforeach;?>
            </select>
        </div>
        <button type="submit" name="addCollector" class="btn btn-primary mt-3">Добавить товар</button>
    </div>
</form>
<?php require_once 'layout/footer.php'; ?>
