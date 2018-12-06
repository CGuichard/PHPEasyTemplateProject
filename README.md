# PHPEasyTemplate

PHPEasyTeamplate is a basic minimal PHP site with a routing / template system, where you can create URLs for the pages of the website and link them to a template.


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development purposes. This project has been made to serve as a base for a PHP website, it is deployable normally as such, like all others.

### Prerequisites

#### Apache

There are a few steps needed to get the project to work. First of all you need an Apache server running on your machine, with PHP 5.6.25 up to 7.0.1, which are the versions used to develop it. There is a lot of tutorials that already exists to install it, check them.

#### Rewrite module

Secondly, you will have to activate the Apache server Rewrite module. Doing it depends of your device and operating system, please check how to do it according to your device and Apache installation if the following instruction don't give you enough informations.

For Windows, with WAMP and XAMP please check the documentation.

For GNU/Linux, you will have to enter the following commands:

	sudo a2enmod rewrite
	sudo /etc/init.d/apache2 restart #restart the Apache service

You will also need to edit the file **/etc/apache2/apache2.conf**.
Find these lines:

	<Directory /var/www/>
    	Options Indexes FollowSymLinks
    	AllowOverride None
    	Require all granted
	</Directory>

Now, replace it by:

	<Directory /var/www/>
    	Options Indexes FollowSymLinks
    	AllowOverride All
    	Require all granted
	</Directory>

If your www folder is not /var/www/, please edit the corresponding Directory tag like that one.
Restart again the Apache service like previously.

#### SQLite

If the sqlite driver does not exist, please install it.

For GNU/Linux distribution, the package is like:

	sudo apt-get install php{version}-sqlite

Use your PHP version at *{version}*. For your device maybe the package will recognize *sqlite3* at the end and not *sqlite*. Then restart your Apache service.

#### One final effort

Finally on GNU/Lunux make sure Apache have the needed rights to run the website (read, write and execute).

### Installing

Once all the prerequisites are met, simply clone this project in the folder where you want to start developing your website.

Make sure to put it in a folder served by the Apache service.

## How to use it

**Note:** By default the website database contains one user, with the login "PHPEasyTemplate" and the password "mypassword" (Yes great security here). You can delete this account in the database if you want.

### Project structure

Here is the structure of the folders and files of the website:

##### Website root files

1. **.htaccess** : Don't touch it, this file is used by Apache and contains the rule to redirect all urls to the management file.
2. **conf.inc.php** : Contains basic variables used by the project, such as the website name, the language etc... Modify it with your website values.
3. **db.sqlite3** : By default this file isn't present, but it is generated at the first load of the website if it doesn't exist.
4. **README.md** : This file.
5. **routes.inf** : Really important, this file contains the routes and associated templates of the website. Modify it to your heart content.
6. **todo.txt** : Don't mind it, this is just my recap of what I want to do in the future.
7. **website.php** : This file IS the most important one. All of the urls' requests are redirected to this file that handles the request. You don't have to modify it.

##### Website root folders

1. **uploads/** : Folder where you can put all of the uploaded files.
2. **templates/** : Contains the file base.php, which is the base of all templates, and two subfolders:
	1. **errors/** : Folder of the error web pages. You can design your own 404 error page for example here.
	2. **pages/** : The folder where you put your php pages. See the next section to know how to add a page.
3. **static/** : Contains all of the static resources.
	1. **img/** : Stores pictures
	2. **libs/** : Puts your libraries here.
	3. **scripts/** : Here you can put javascript scripts or sql for your database.
	4. **styles/** : Contains CSS files and fonts for your website.
4. **includes/** : Divided in two subfolders:
	1. **modals/** : You can put your modal files here.
	2. **parts/** : Contains all of the website parts used in every page. You can modify here the content of your footer, your navigation bar etc...
5. **doc/** : Classic one. Put your documentation here.
6. **api/** : All PHP functions are developed here. This here your website api. Contains:
	1. **init.inc.php** : File loaded by *website.php*. All of the files needed for your website have to be loaded in it.
	2. **v1/** : Version 1 of the api. You can find in it:
		1. **ajax/** : This folder contains all of the pages used by AJAX requests in the project base.
		2. **controlers/** : Contains controler files, files used to define functions to manipulate the model classes with the database.
		3. **models/** : Contains the classes corresponding to your database tables.
		4. **PHPEasyTemplate/** : Contains all of the basic functions used in the project. This part is not meant to be modified.

### Add a page to the website

To add a page to the website, you need to add its url route in the file **routes.inf**, and link it with its template with the same syntax as the other routes.

    /my/url/route/ @mypage.php

Then you need to create your page in the folder **/templates/pages/**.

To create a basic page, you will need this base:

    <?php
	  $PAGE_TITLE = "Your page title";
	  $PAGE_SECTION = "Section in the navbar that will be active";
	  $PAGE_CONTENT = "Description of the page";
	?>

	// Content here

	<?php require_once( template("base.php") ); ?>

In the place of the comment you have to use PHP ob functions, like this:


	<?php ob_start(); ?>
		// Content you want to add
	<?php $page_content = ob_get_clean(); ?>

The tag $page_content here is used to place the content of your web page. There exists some other tags, all listed in the template **example.php**. Here is the list: 

1. **$metas_content** : Adds metas in <head\>
2. **$css_content** : Adds css links in <head\>
3. **$page_content** : Adds the content of the page
4. **$modals_content** : Adds specific modals to the page
5. **$scripts_content** : Adds scripts at the bottom of the page

### Advice

I invite you to see how the template works by observing how this project works, to see how things are done. I invite you to check all of the functions of the folder **api/v1/PHPEasyTemplate/**, because all of these functions can be used in every template of the website and are really important, like **url_for("/you/url/route")**, used to create a link to another page. 

Please check all of this folder files to truly discover the functionalities of this template project.

## Built With

* [Material Design for Bootstrap 4](https://mdbootstrap.com/) - The CSS framework used (Bootstrap 4 based)
* [Font Awesome](https://fontawesome.com/) - Icon set and toolkit
* [Browser](https://github.com/cbschuld/Browser.php) - PHP Library used to detect browsers
* [Jarallax](https://github.com/nk-o/jarallax) - Library used to make parallax effect on web pages

## Contributing

Due to certain circumstances, the project will be suspended for a while, however it is possible to send a message to trace bugs or to improve it.

## Versioning

This project does not originally use any versioning, versioned development starting at the time of deployment of the code on Github for version 1.

## Authors

* **Clément GUICHARD** - *Maintainer*
