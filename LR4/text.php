<?php
include "layout/header.php";
include "defaultValue.php";
$defaultValue = getValuesFromPost();
?>
    <div class="container">
        <form class="m-5" action="text.php" method="post">
            <label for="textarea">Введите текст</label>
                <?php if (!empty($_GET['preset'])): ?>
                    <textarea id="textarea" class="form-control mt-3" name="textarea" style="height: 350px;"><?= file_get_contents(__DIR__.'/'. "preset" . $_GET['preset'] . ".html") ?></textarea>
                <?php else: ?>
                    <textarea id="textarea" class="form-control mt-3" name="textarea" style="height: 350px;"><?= htmlspecialchars($defaultValue) ?></textarea>
                <?php endif ?>
            <button name="button" type="submit" class="btn btn-primary mt-2">Отправить</button>
        </form>
        <?php if (isset($_POST['button']) && !empty($_POST['textarea'])): ?>
            <?php include "textLogic.php"; ?>
            <?php if (!empty($replacedDashesInTexts)): ?>
                <div class="fs-3">Задание 5:</div>
                <div><?= $replacedDashesInTexts ?></div>
            <?php endif ?>
            <?php if (!empty($replacedDotsInTexts)): ?>
                <div class="fs-3">Задание 8:</div>
                <div><?= $replacedDotsInTexts ?></div>
            <?php endif ?>
            <?php if (!empty($headersWithHtml)): ?>
                <div class="fs-3">Задание 11:</div>
                <div><?= $headersWithHtml[0] ?></div>
                <div><?= $headersWithHtml[1] ?></div>
            <?php endif ?>
            <?php if (!empty($htmlWithoutRecurringStyles)): ?>
                <div class="fs-3">Задание 20:</div>
                <div><?= $htmlWithoutRecurringStyles ?></div>
            <?php endif ?>
            <?php if (!empty($allTables)): ?>
                <?php foreach ($allTables as $number=>$table): ?>
                    <table id="table<?= $number?>">
                        <?php foreach ($table as $rowData): ?>
                            <tr>
                                <?php foreach($rowData as $cell): ?>
                                    <td class="pe-3"><?= $cell ?></td>
                                <?php endforeach ?>
                            </tr>
                        <?php endforeach ?>
                    </table>
                <?php endforeach ?>
            <?php endif ?>
        <?php endif ?>
    </div>
<?php include "layout/footer.php"; ?>