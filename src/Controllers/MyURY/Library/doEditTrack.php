<?php
/**
 * Allows URY Librarians  to create edit Tracks
 * 
 * @author Lloyd Wallis <lpw@ury.org.uk>
 * @version 25042013
 * @package MyURY_Library
 */

//The Form definition
require 'Models/MyURY/Library/trackfrm.php';

$data = $form->readValues();

$track = MyURY_Track::getInstance($data['trackid']);
$track->setTitle($data['title']);
$track->setArtist($data['artist']);

require 'Views/MyURY/Core/back.php';