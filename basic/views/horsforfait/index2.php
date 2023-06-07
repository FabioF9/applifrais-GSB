<?php
/** @var yii\web\View $this */
$connection = Yii::$app->db;
$command = $connection->createCommand("SELECT * FROM `horsforfait`");
$clients = $command->queryAll();
print_r($clients);
?>
<h1>horsforfait/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
