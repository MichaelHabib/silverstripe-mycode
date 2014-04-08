<?php
include "_AdminDetails.php";
include "CustomExtensionsConfig.php";
include "GadgetsConfig.php";
include "CustomTemplatesLoaderConfig.php";

ImageExtension::set_showPlaceHolder(true);

// Set the site locale
i18n::set_locale('en_AU');
date_default_timezone_set('Australia/Melbourne');


/*
 * --------------------------------------------
 * http://www.ssbits.com/snippets/2010/a-config-php-cheatsheet/
 * --------------------------------------------
 */
//Force enviroment to Dev ** REMOVE FOR LIVE SITES **
Director::set_environment_type("dev");
Requirements::set_combined_files_enabled( false);




/**********************
 *
 * Templates / ULRs
 *
 **********************/
SSViewer::set_source_file_comments(true); 
SSViewer::set_theme('Base1');


//Enable Search, use $SearchForm in template
FulltextSearchable::enable();

//Turn off # link rewriting
//SSViewer::setOption('rewriteHashlinks', false);

//Force redirect to www.
//Director::forceWWW();

// Set the Breadcrumb divider
//SiteTree::$breadcrumbs_delimiter = " >> ";

// Set the resizing image quality
GD::set_default_quality(95);

LeftAndMain::require_css("themes/" . SSViewer::current_theme() . "/css/CMS.css");


/**********************
 *
 * Comments
 *
 **********************/

//Enable comment spam protection
//MathSpamProtection::setEnabled();

//Enable comment moderation
//PageComment::enableModeration();

//Force user to be logged in to post a comment
//PageCommentInterface::set_comments_require_login(true);

/**********************
 *
 * CMS Rebranding
 *
 **********************/
//
//Set the CMS application name, logo and loading image
//LeftAndMain::setApplicationName("My application");
//LeftAndMain::setLogo("themes/MyTheme/images/CMSLogo.png", "margin-top: -3px;");
//LeftAndMain::set_loading_image('themes/MyTheme/images/CMSLoading.gif');