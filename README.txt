CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Requirements
 * Installation
 * Configuration
 * How it works
 * Support requests
 * Maintainers


INTRODUCTION
------------

Social Auth Yahoo is a Yahoo authentication integration for Drupal. It is
based on the Social Auth and Social API projects

It adds to the site:
 * A new url: /user/login/Yahoo.
 * A settings form at /admin/config/social-api/social-auth/Yahoo.
 * A Yahoo logo in the Social Auth Login block.


REQUIREMENTS
------------

This module requires the following modules:

 * Social Auth (https://drupal.org/project/social_auth)
 * Social API (https://drupal.org/project/social_api)


INSTALLATION
------------

 * Run composer to install dependencies:
   composer require "drupal/social_auth_yahoo:^2.0"

 * Install the dependencies: Social API and Social Auth.

 * Install as you would normally install a contributed Drupal module. See:
   https://drupal.org/documentation/install/modules-themes/modules-8
   for further information.

 * A more comprehensive installation instruction for Drupal 8 can be found at
   https://www.drupal.org/docs/8/modules/social-api/social-api-2x/social-auth-2x/social-auth-yahoo-2x-installation


CONFIGURATION
-------------

 * Add your yahoo project OAuth information in
   Configuration » User Authentication » yahoo.

 * Place a Social Auth Login block in Structure » Block Layout.

 * If you already have a Social Auth Login block in the site, rebuild the cache.


HOW IT WORKS
------------

The user can click on the yahoo logo on the Social Auth Login block
You can also add a button or link anywhere on the site that points
to /user/login/yahoo, so theming and customizing the button or link
is very flexible.

After yahoo has returned the user to your site, the module compares the user
id or email address provided by yahoo. If the user has previously registered
using yahoo or your site already has an account with the same email address,
the user is logged in. If not, a new user account is created. Also, a yahoo
account can be associated with an authenticated user.


SUPPORT REQUESTS
----------------

 * Before posting a support request, carefully read the installation
   instructions provided in module documentation page.

 * Before posting a support request, check the Recent Log entries at
   admin/reports/dblog

 * Once you have done this, you can post a support request at module issue
   queue: https://www.drupal.org/project/issues/social_auth_yahpp

 * When posting a support request, please inform if you were able to see any
   errors in the Recent Log entries.


MAINTAINERS
-----------

Current maintainers:
 * Getulio Sánchez (gvso) - https://www.drupal.org/u/gvso
 * Himanshu Dixit (himanshu-dixit) - https://www.drupal.org/u/himanshu-dixit
