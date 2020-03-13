#### :zap:Package Archived and Abandoned :zap:
This package is abandoned and no longer maintained. Feel free to fork and maintain this if you prefer, but storage is now cheap so 
this package should not be needed at all. And in case you need to upload the project through FTP, please please please, urge the person in charge to change the host and deployment strategy to a better way.

# composer-cleaner
Clean up laravel 5 unneeded test and documentation files from your composer vendor libraries

Based from https://github.com/barryvdh/laravel-vendor-cleanup

# Problem
Some (most) of the clients that me and my co-worker need to create websites for, are still using a shared hosting without any ssh access which makes 
deployment much harder than it is supposed to be. We had to deploy the files to the server using ftp and when we have package updates,
uploading the vendor directory took a very long time which causes a lot of downtime.

This package is made so that we could reduce the vendor folder files and size, minimizing downtime and to save up some spaces since shared 
hosting usually have limited storage.


# Installation
Add it to your composer.json or simply by running   
````bash
$ composer require askaoru/composer-cleaner
````

Then add the service provider to your `config/app.php` under the providers array  
````php
'providers' => [
    // Other laravel packages ...
    
    Askaoru\ComposerCleaner\ComposerCleanerServiceProvider::class,
],
````

Publish the config
````bash
$ php artisan vendor:publish --provider="Askaoru\ComposerCleaner\ComposerCleanerServiceProvider"
````
That will create 1 file which you can edit to change library cleaning rules
````
config\cleaner.php
````

# Usage
You can use this package by running
````bash
$ php artisan composer-clean
````



That's about it. If you have any question or suggestion, feel free to open an issue. Contributions and criticism will be appreciated!

Thank you.
