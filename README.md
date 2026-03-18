# pocketspigot
PocketSpigot is middleware to bridge the modern web and its resources to the small web. 
PocketSpigot is licensed under the MPL 2.0 - see LICENSE for more info

WHY IS IT USEFUL?

Most web resources today are served over HTTPS, locked behind an API (HTTPS!),
or otherwise inaccessable to sites on the old web. As the web has diverged in
many different directions, this makes it difficult to aggregate or gather
data when using older browsers, applications, etc.

PocketSpigot is a simple to deploy middleware solution that grabs those 
resources as configured and allows you to serve them to your application 
or service via good old fashioned HTTP. You can choose from several endpoint
types depending on what you're trying to connect to/from. 



HOW IT WORKS:

You can deploy PocketSpigot in a directory on your webserver.

You'll need PHP, and maybe MySQL if you don't want the owner
of your scraped resources to hate you. 

You'll need to edit the settings.php file per your scraped resource,
titling each one, i.e. "NPR Tech News" or "Hackernews Front Page RSS".

If MySQL is enabled, each entry is cached in the DB and will only scrape
as often as you set in the $ps->interval (milliseconds; 3600 default)

When a scrape happens, the most recent results will be compared to the
corresponding table in the database. This will diff and add the newest items,
as well as their fetch_timestamp. This, in turn, will be the data accessed 
by your (HTTP!) endpoint. 