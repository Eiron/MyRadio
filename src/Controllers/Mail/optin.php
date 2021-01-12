<?php
/**
 * Opt in to a mailing list.
 */
use \MyRadio\MyRadioException;
use \MyRadio\MyRadio\AuthUtils;
use \MyRadio\MyRadio\URLUtils;
use \MyRadio\ServiceAPI\MyRadio_List;
use \MyRadio\ServiceAPI\MyRadio_User;

if (!isset($_REQUEST['list'])) {
    throw new MyRadioException('List ID was not provided!', 400);
}

if (isset($_REQUEST['memberid'])) {
    AuthUtils::requirePermission(AUTH_EDITANYPROFILE);
    $user = $_REQUEST['memberid'];
} else {
    $user = -1;
}

$list = MyRadio_List::getInstance($_REQUEST['list']);
if ($list->optin(MyRadio_User::getInstance($user)->getID())) {
    URLUtils::backWithMessage('You are now subscribed to '.$list->getName().'.');
} else {
    URLUtils::backWithMessage(
        'You could not be subscribed at this time. '
        .'You may already have opted-in or it may not be an open mailing list.'
    );
}
