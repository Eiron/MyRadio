<?php
/**
 * Edit an Officer
 * 
 * @author Lloyd Wallis <lpw@ury.org.uk>
 * @version 20130809
 * @package MyURY_Profile
 */

$officer = MyURY_Officer::getInstance($_REQUEST['officerid']);

CoreUtils::getTemplateObject()
        ->setTemplate('Profile/officer.twig')
        ->addVariable('title', $officer->getName())
        ->addVariable('officer', $officer->toDataSource(true))
        ->render();