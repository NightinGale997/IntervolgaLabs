<?php
include "layout/header.php";
include "defaultValue.php";
$defaultValue = getValuesFromPost();
?>
<div class="container">
    <form class="m-5" action="text.php" method="post">
        <label for="form-control">Введите текст</label>
        <textarea class="form-control mt-3" name="text"><?php
            if (!empty($_GET['preset'])) {
                $file = "preset".$_GET['preset'].".html";
                echo file_get_contents(__DIR__.'/'.$file);
            }
            else{
                echo htmlspecialchars($defaultValue);
            }
            ?></textarea>
        <button name="button" type="submit" class="btn btn-primary mt-2">Отправить</button>
    </form>
    <?php
    if (isset($_POST['button']) && !empty($_POST['text'])) {
        include "textLogic.php";
        if (!empty($replacedTexts)) {
            ?>
            <div class="fs-3">Задание 8:</div>
            <div><?= $replacedTexts ?></div><?php
        }
        if (!empty($tableContent)) {
            ?>
            <div class="fs-3">Задание 12:</div>
            <?= $tableContent?>
        <?php }
        if (!empty($htmlWithoutRecurringStyles)) {
            ?>
            <div class="fs-3">Задание 20:</div>
            <div><?= $htmlWithoutRecurringStyles ?></div><?php
        }

        if (!empty($allTables)) {
            foreach ($allTables as $number=>$table) { ?>
                <table id="table<?= $number?>">
                    <?php foreach ($table as $rowData) { ?>
                        <tr>
                            <?php foreach ($rowData as $cell) { ?>
                                <td class="pe-3"><?= $cell ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            <?php }
        }
    }
    ?>
</div>
<?php include "layout/footer.php"; ?>