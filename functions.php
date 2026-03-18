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