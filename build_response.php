<?php

/*
 * build_response.php
 * @goloins 2026-03-18
 * 
 * Response builder for PocketSpigot. 
 * This file is customizable depending on what you need the output of your PocketSpigot instance to be.
 * For example, if you're using PocketSpigot to scrape an RSS feed and you want to
 * output the news items as a JSON API, you would customize the build_response function to format the news items as JSON.
 * Whatever you write here will be used to build the response that is returned when the PocketSpigot instance is accessed
 * via whatever method you chose (PocketMain, json, custom api endpoint, etc).
 * 
 * The example build_response function included here is a very basic implementation that simply returns the news items as a JSON array.
 * The returned data will be included in global $letsgo variable that is expected by the default endpoints in main.php.
 * 
 * You should only make changes here and leave main.php alone.
 * 
 * Part of the PocketSpigot Project
 * Copyleft (c) 2026 PocketSpigot Team
 * 
 * This program is licensed under the Mozila Public License Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://www.mozilla.org/MPL/
 */
 
include_once 'settings.php';
include_once 'functions.php';

global $letsgo;

if(!db_check_freshness()) {
    // If the data is not fresh, fetch new data and update the database
    $news_items = ps_fetch_resource();
    if($ps['cache_to_db']) {
        db_compare_feed_and_update();
    }
} else {
    // If the data is fresh, fetch it from the database
    $news_items = db_fetch_news_items();
}

function build_response($news_items) {
    // This is where you would customize the response format. The example here simply returns the news items as a JSON array.
    // You can customize this to return whatever format you want, such as XML, HTML, or a custom API response.
    return json_encode($news_items);
}