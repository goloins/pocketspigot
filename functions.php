<?php

/*
 * functions.php
 * @goloins 2026-03-18
 * 
 * Functions and Basic Methods for PocketSpigot
 * Feel free to customize this as needed for your PocketSpigot instance. 
 * This file contains all the necessary functions and basic methods that are used throughout the PocketSpigot project.
 * 
 * Part of the PocketSpigot Project
 * Copyleft (c) 2026 PocketSpigot Team
 * 
 * This program is licensed under the Mozila Public License Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://www.mozilla.org/MPL/
 */
 
include_once 'settings.php';

/*

Core Fetch Functionality

This is where any additional methods should be added. 
The basic fetch functions for RSS, API, and HTML are included here as painfully simple examples.

If you want to do some wild shit, this is the place to put the function to handle it. 

*/


// The basic RSS fetch function, this will be used if the resource type is set to RSS.
// Feel free to tear it apart, it's basic and lean.
function ps_fetch_rss_feed($url) {
    // Fetch the RSS feed and return the items as an array
    $rss = simplexml_load_file($url);
    $items = array();
    foreach ($rss->channel->item as $item) {
        $items[] = array(
            'title' => (string)$item->title,
            'link' => (string)$item->link,
            'description' => (string)$item->description,
            'pubDate' => (string)$item->pubDate
        );
    }
    return $items;
}

// The basic API data fetch function. You can customize what you pull from it here or from the 
// returned data in main.php
function ps_fetch_api_data($url) {
    // Fetch data from an API and return it as an array
    $response = file_get_contents($url);
    return json_decode($response, true);
}


// The basic HTML fetch function. This is a very basic implementation and is not recommended for complex HTML parsing.
// If you want to use this, you will need to customize it heavily for your specific use. We're using regex here
// because we're stupid and ignore the words of the giants whos shoulders we stand on. Godspeed.
function ps_fetch_html_data($url, $regex) {
    // Fetch HTML content and return matches based on the provided regex
    $html = file_get_contents($url);
    preg_match_all($regex, $html, $matches);
    return $matches;
}


/* 

Core Database Functionality

This is where we're going to interact with the database if enabled. 
It is HIGHLY recommended you use the database for this, 
otherwise someone will block your IP for hitting their shit too much.

*/

function db_get_latest_entries($num) {
    // Implementation for fetching latest $num entries from the database

}

function db_insert_feed_item($item) {
    // Implementation for inserting a new feed item into the database
}

function db_compare_feed_and_update(){
    // Implementation for comparing feed data and updating the database
}

