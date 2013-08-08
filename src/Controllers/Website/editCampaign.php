<?php
/**
 * Edit a Campaign
 * 
 * @author Lloyd Wallis <lpw@ury.org.uk>
 * @version 20130808
 * @package MyURY_Website
 */

(new MyURYForm('test', 'Website', 'doEditCampaign'))
        ->addField(new MyURYFormField('test', MyURYFormField::TYPE_WEEKSELECT,[
            value => MyURY_BannerCampaign::getInstance($_REQUEST['campaignid'])->getTimeslots()
        ]))
                ->render();