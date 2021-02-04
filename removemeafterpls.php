<?php

include_once './vendor/autoload.php';

$service = new \App\Model\Service\CommitMessageService();
$commitHash = "12071ef6d091a6fcc969ad7a363e1757";
$commitMessage = "[add] [feature] @core #123456 Integrovat Premier: export objednávek

* Export objednávek cronem co hodinu.
* Export probíhá v dávkách.
* ...

BC: Refaktorovaný BaseImporter.
BC: ...

Feature: Nový logger.

TODO: Refactoring autoemail modulu.";
$service->create($commitHash, $commitMessage);