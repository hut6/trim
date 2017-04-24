# Trim plugin for Craft CMS

Smart truncating based on Roi Kingon's Trimmer plugin

## Installation

To install Trim, follow these steps:

1. Download & unzip the file and place the `trim` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/hut6/trim.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require hut6/trim`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `trim` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Trim works on Craft > 2.4.x

## Using Trim

    trimit($text, $length = 100, $ellipsis = "...")

    trimit("insert your string here", 100, "...")
    "insert your string here"|trimit(100, "...")

## Updates

* 1.1.0
    * Refactoring. Changed default hellipsis. Removed white space and word paramaters.
* 1.0.1
	* Fixed Twig issues with white space filtering and dealing with HTML entities
* 1.0.0
	* Initial release
