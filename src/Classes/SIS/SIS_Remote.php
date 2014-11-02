<?php

/*
 * This file provides the SIS_Remote class for MyRadio
 * @package MyRadio_SIS
 */

namespace MyRadio\SIS;

use \MyRadio\Config;
use \MyRadio\ServiceAPI\ServiceAPI;
use \MyRadio\ServiceAPI\MyRadio_Selector;
use \MyRadio\ServiceAPI\MyRadio_Webcam;
use \MyRadio\MyRadio\MyRadioNews;

/**
 * This class has helper functions for long-polling SIS
 *
 * @version 20131101
 * @author Andy Durant <aj@ury.org.uk>
 * @package MyRadio_SIS
 */
class SIS_Remote extends ServiceAPI
{

    /**
     * Gets the latest presenter info
     * @param  array $session phpSession variable
     * @return array presenter info data
     */
    public static function queryPresenterInfo($session) {
        if ($_REQUEST['presenterinfo-lasttime'] < time() - 300) {
            $response = MyRadioNews::getLatestNewsItem(Config::$presenterinfo_feed);
            return [
                'presenterinfo' => ['time' => time(), 'info' => $response]
            ];
        } else {
            return [];
        }
    }

    /**
     * Gets the latest messages for the selected timeslot
     * @param  array $session phpSession variable
     * @return array message data
     */
    public static function queryMessages($session)
    {
        $response = SIS_Messages::getMessages($session['timeslotid'], isset($_REQUEST['messages_highest_id']) ? $_REQUEST['messages_highest_id'] : 0);

        if (!empty($response) && $response !== false) {
            return ['messages' => $response];
        }
    }

    /**
     * Gets the latest tracklist data for the selected timeslot
     * @param  array $session phpSession variable
     * @return array tracklist data
     */
    public static function queryTracklist($session)
    {
        $response = SIS_Tracklist::getTrackListing($session['timeslotid'], isset($_REQUEST['tracklist_highest_id']) ? $_REQUEST['tracklist_highest_id'] : 0);

        if (!empty($response) && $response !== false) {
            return ['tracklist' => $response];
        }

    }

    /**
     * Gets the latest selector status
     * @param  array $session phpSession variable
     * @return array selector status
     */
    public static function querySelector($session)
    {
        $response = MyRadio_Selector::getStatusAtTime(time());

        if ($response['lastmod'] > $_REQUEST['selector_lastmod']) {
            return ['selector' => $response];
        }
    }

    /**
     * Gets the latest webcam status
     * @param  array $session phpSession variable
     * @return array webcam status
     */
    public static function queryWebcam($session)
    {
        $response = MyRadio_Webcam::getCurrentWebcam();

        if ($response['current'] != $_REQUEST['webcam_id']) {
            return ['webcam' => $response];
        }
    }
}
