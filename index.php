<?php
    // Folgende Zeile im Produktivmodus entfernen:
    defined('YII_DEBUG') or define('YII_DEBUG',true);
    // Yii-Startdatei einbinden
    require_once('lib/yii/framework/yii.php');
    // Instanz einer Applikation erzeugen und starten
    $configFile='protected/config/main.php';
    Yii::createWebApplication()->run();
?>