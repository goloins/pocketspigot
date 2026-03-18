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
    * 'name' - The name of your PocketSpigot instance. For example, if you're using PocketSpigot to scrape the NPR Technology
    *       RSS feed, you might set this to "NPR Technology News".
    * 'description' - A brief description of your PocketSpigot instance. This can be used for documentation or display purposes.
    * 'cache_to_db' - A boolean setting that determines whether to cache news items to a MySQL database. If set to false,
    *       news items will not be cached to the database and will be fetched directly from the RSS feed each time.
    *       WARNING: Setting this to false may lead to increased load on the RSS feed and may cause issues if the feed is rate-limited.
    * 'standalone' - A boolean setting that indicates whether this PocketSpigot instance is standalone or if you're directing it from
    *       PocketMain. If you're just mirroring one feed and not using PocketMain to manage multiple feeds, you can set this to true.

*/

$ps = array(
    'name' => 'PocketSpigot News Feed',
    'description' => 'PocketSpigot News Feed is an example of PocketSpigot using RSS to provide news via an API for Small Web Projects',
    'cache_to_db' => true,
    'db_ref' = NULL,
    'standalone' => false
    );

global $ps;

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

