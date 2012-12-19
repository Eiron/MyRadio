<?php

require 'Views/MyURY/Scheduler/bootstrap.php';

$twig->setTemplate('MyURY/Scheduler/showList.twig')
        ->addVariable('heading', 'My Shows')
        ->addVariable('tabledata', ServiceAPI::setToDataSource($shows))
        ->addVariable('tablescript', 'myury.scheduler.showlist');
if (isset($_REQUEST['msg'])) {
  switch($_REQUEST['msg']) {
    case 'seasonCreated':
      $twig->addInfo('Your season application has been submitted for processing.');
      break;
  }
}

$twig->render();