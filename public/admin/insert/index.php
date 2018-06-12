<?php
include_once filter_input(INPUT_SERVER,"DOCUMENT_ROOT")."/../vendor/autoload.php";
$ctrl = new \Ufrpe\Senadores\Modules\Extractor\Control\ExtractorController();
$ctrl->inserts();