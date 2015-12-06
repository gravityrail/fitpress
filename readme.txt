=== FitPress ===
Contributors: Daniel Walmsley
Tags: fitness, fitpress, fitbit
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Publish your FitBit statistics on your WordPress blog.

== Description ==

Currently:

* A shortcode for "heartrate" which takes a "date" parameter and prints a simple list of time spent in each heart rate zone for the day
* A shortcode for "steps" which prints a graph of steps taken over a 7 day period before the given "date"

See the "Usage" section for an example.

The hope is that eventually this plugin will provide the following functionality:

* Sidebar Widgets which display fitness statistics (e.g. heart rate over time)
* Post types which post to FitBit, e.g. meals
* Shortcodes to include graphs and tables of fitbit data in posts

== Installation ==

1. Save this plugin in your wp-content/plugins directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Usage ==

1. Connect the FitBit account for your user account by clicking "Link my FitBit Account" at the bottom of your profile page.
1. In any post:

```
My heart rate: [heartrate date="2015-12-04"]

Steps: [steps date="2015-12-04"]
```

== Changelog ==

= 0.2 =

Switch to simple pure-PHP OAuth2 implementation

= 0.1 =

Non-functional version with settings and dependencies only

== Credits ==

This plugin was originally a thin wrapper around other people's work, but has now evolved significantly. Nevertheless, credit where credit is due to these awesome projects:

* [FitbitPHP](https://github.com/heyitspavel/fitbitphp) by *heyitspavel*
* [PHPoAuthLib](https://github.com/Lusitanian/PHPoAuthLib) by [David Desberg](https://daviddesberg.com/)