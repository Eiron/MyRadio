<?php
/**
 * Creates a NIPSWeb Play Token for the Current User and the given trackid
 *
 * @package MyRadio_NIPSWeb
 */

use \MyRadio\MyRadio\URLUtils;
use \MyRadio\NIPSWeb\NIPSWeb_Token;

NIPSWeb_Token::createToken($_REQUEST['trackid']);

URLUtils::nocontent();
