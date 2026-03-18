<?php

/*
 * settings.php 
 * @goloins 2026-03-18
 * 
 * Settings and Variable Configuration for PocketSpigot
 * This file contains all the necessary settings and variable configurations for the PocketSpigot instance.
 * 
 * 
 * Part of the PocketSpigot Project
 * Copyleft (c) 2026 PocketSpigot Team
 * 
 * This program is licensed under the Mozila Public License Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://www.mozilla.org/MPL/
 */



/*
    * MySQL Database Settings
    * These settings are used to connect to the MySQL database for caching news items if cache_to_db is enabled.
    * Make sure to update these settings with your actual database credentials. If you're just hammering the 
    * RSS feed and don't want to use a database, you can leave these settings as they are, but ensure that 
    * cache_to_db is set to false in the $ps array below.
*/
$ps_mysqli_settings = array(
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'pocketspigot_news'
);

/*
    * General PocketSpigot Settings
    * This array contains general settings for the PocketSpigot instance. You can customize these settings as needed.
    *
    * 'name' - The name of your PocketSpigot instance. For example, if you're using PocketSpigot to scrape the NPR Technology
    *       RSS feed, you might set this to "NPR Technology News".
    *
    * 'description' - A brief description of your PocketSpigot instance. This can be used for documentation or display purposes.
    *
    * 'cache_to_db' - A boolean setting that determines whether to cache news items to a MySQL database. If set to false,
    *       news items will not be cached to the database and will be fetched directly from the RSS feed each time.
    *       WARNING: Setting this to false may lead to increased load on the RSS feed and may cause issues if the feed is rate-limited.
    *
    * 'standalone' - A boolean setting that indicates whether this PocketSpigot instance is standalone or if you're directing it from
    *       PocketMain. If you're just mirroring one feed and not using PocketMain to manage multiple feeds, you can set this to true.
    *
    * 'resource_type' - A string that indicates the type of resource being scraped. Your options include:
            * 'RSS' - For RSS feeds. This is the most common resource type for PocketSpigot.
            * 'HTML' - For scraping news items directly from HTML pages. As a wise man once said, you cannot use REGEX to parse HTML
                    However, we're stupid so we're going to do it anyway. Read on for more details on how to use this resource type.
            * 'API' - For scraping news items from APIs. Read on for more details on how to use this resource type.
    * 'resource_settings' - An array that contains settings specific to the resource type being scraped. This points to an array
                    customized for the resource type being scraped. 
*/

$ps = array(
    'name' => 'PocketSpigot News Feed',
    'description' => 'PocketSpigot News Feed is an example of PocketSpigot using RSS to provide news via an API for Small Web Projects',
    'cache_to_db' => true,
    'db_ref' => NULL,                   // Do not touch, this will be set later by internal logic.
    'standalone' => false,
    'resource_type' => 'RSS',
    'resource_settings' => NULL         // Do not touch, this will be set later by internal logic.
    );

$resource_settings_rss = array(
    'feed_url' => 'https://www.myEXAMPLEfeed.com/rss/rss.php?id=1019', // The URL of the RSS feed to scrape. You can change this to any RSS feed you want.
    'item_limit' => 10, // The maximum number of items to pull down
);

$resource_settings_html = array(
    'target_url' => 'https://www.myEXAMPLEfeed.com/sections/technology/', // The URL of the HTML page to scrape. You can change this to any HTML page you want.
    'item_selector' => '.item-info', // The CSS selector for the news items on the HTML page. This is used to identify the news items to scrape. You will need to inspect the HTML structure of the target page and update this selector accordingly.
    'title_selector' => '.title', // The CSS selector for the title of the news item. This is used to extract the title of the news item from the HTML. You will need to inspect the HTML structure of the target page and update this selector accordingly.
    'link_selector' => '.title a', // The CSS selector for the link of the news item. This is used to extract the link of the news item from the HTML. You will need to inspect the HTML structure of the target page and update this selector accordingly.
    'description_selector' => '.teaser', // The CSS selector for the description of the news item. This is used to extract the description of the news item from the HTML. You will need to inspect the HTML structure of the target page and update this selector accordingly.
);

$resource_settings_api = array(
    'endpoint_url' => 'https://api.myEXAMPLEfeed.com/query?fields=title,teaser,link&searchType=fullText&format=json&id=1019', // The URL of the API endpoint to scrape. You can change this to any API endpoint you want.
    'item_limit' => 10, // The maximum number of items to pull down
);



/******************************************************************************************************/
/* NO MORE EDIT LINE, YOU SHOULD NOT NEED TO EDIT BELOW THIS LINE UNLESS YOU KNOW WHAT YOU'RE DOING */
/* CUSTOM FUNCTIONS AND METHODS SHOULD BE PLACED IN FUNCTIONS.PHP, NOT HERE. KTHXBAI <3 */
/******************************************************************************************************/

// Here we're going to select which array to point 'resource_settings' to based on the resource type.
// If you're using a custom type, be sure you add it to the switch statement and point it to the appropriate settings array.
// This is one of two places you'll need to add it, but that will be documented at some point. 
// It's 11am on a Wednesday and I'm tired, cut me some slack.


switch($ps['resource_type']) {
    case 'RSS':
        $ps['resource_settings'] = $resource_settings_rss;
        break;
    case 'HTML':
        $ps['resource_settings'] = $resource_settings_html;
        break;
    case 'API':
        $ps['resource_settings'] = $resource_settings_api;
        break;
    default:
        die('Invalid resource type specified in $ps. You supplied: ' . $ps['resource_type'] . '. Valid options are: RSS, HTML, API. Typo?');
}


// Building the database connection if caching to the database is enabled, 
// then shoveling the database reference into the $ps array for simplicitys sake

if($ps['cache_to_db']) {
    // Database connection settings
    $mysqli = new mysqli($ps_mysqli_settings['host'], $ps_mysqli_settings['username'], $ps_mysqli_settings['password'], $ps_mysqli_settings['database']);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }else{
        $ps['db_ref'] = $mysqli;
    }
}

global $ps;