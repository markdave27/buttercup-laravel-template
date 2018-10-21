
![Laravel](https://laravel.com/assets/img/components/logo-laravel.svg "Laravel")  
  
[![Build Status](https://travis-ci.org/laravel/framework.svg "Build Status")](https://travis-ci.org/laravel/framework)  
[![Build Status](https://poser.pugx.org/laravel/framework/d/total.svg "Total Downloads")](https://travis-ci.org/laravel/framework)  
[![Build Status](https://poser.pugx.org/laravel/framework/v/stable.svg "Latest Stable Version")](https://travis-ci.org/laravel/framework)  
[![Build Status](https://poser.pugx.org/laravel/framework/license.svg "License")](https://travis-ci.org/laravel/framework)  
  
# Buttercup Laravel Template Portal #  
  
  
About Buttercup Laravel Template  
---  
"So build-it up, buttercup baby!" Buttercup Laravel template aims to give you a streamline way of creating your Laravel back-end / admin modules bases. It provides a copy-paste template for your controller and views which will save you time in your development, the output are consistent and can be adjusted based on your module needs.  It is still a work in progress but is usable for learning and/or basis for your back-end / admin pages.
  
Run Buttercup Laravel Template on your server  
---  
 - Clone project on your server. (git URL + . on end to clone on current path)  
 - Create a database for the system.  
 - Copy **.env.example** and open the copied **.env.example** file with your text editor save it as **.env** on the Laravel root directory  
 - Open the **.env** file and fill out the database information (**database name** of previously created database, **username** and **password** for the created database)  
 - Open a command line / terminal window on the system root directory.  
 - On the command line / terminal window, install composer dependencies by running `composer install` command on the root directory. You should have [Composer](https://getcomposer.org/download/) installed on your system or have composer.phar on the root directory. This may take some time. Wait for it to finish.  
 - Generate application key by running php `artisan key:generate`  
 - Create the database tables via migration by running `php artisan migrate`  
 - Populate database tables with initial data by running `php artisan db:seed`  
 - Follow the guide in setting up [Laravel Snappy](https://github.com/barryvdh/laravel-snappy) 
  
Local Host Additional Setup  
---  
For a local host running in XAMPP follow the instructions on this [link](https://stackoverflow.com/questions/27754367/how-to-set-up-apache-virtual-hosts-on-xampp-windows)  
or use [Laragon](https://laragon.org/)
  
Virtual Private Server (VPS) Additional Setup  
---  
For Ubuntu servers follow the instructions on this [link](http://laravel-recipes.com/recipes/25/creating-an-apache-virtualhost) or [this link](https://indrabustami.wordpress.com/2015/05/12/installation-of-lamp-laravel-5-virtualhost-on-ubuntu-14-04/)  
  
Default Users  
---  
User Type     | Username | Password  
------------- | -------- | --------  
Administrator | admin    | admin123  
User          | user     | user123  
  
Working Features  
---  
 - Account activation via email confirmation (to enable and disable this update the .env variable SETTINGS_SEND_ACTIVATION_EMAIL
 - DataTables with Button index page with PDF, CVS and Excel export
 - Customizable validation error messages
 -  Structured controller, models and views
 - Bower managed resources (found at the public folder)
 - Templated / dynamic controller setup (just copy - paste and modify)
 - Templated / dynamic views (just copy - paste and modify)

## Planned Future Features
- Generator for controller, model, migration, seeder, sample / test data and views
- Database seeder folder for DatabaseSeeder to loop and run the classes (no more need to modify DatabaseSeeder file just create a database seeder class inside the folder)
- Model relationship for DataTables (currently using MySQL User Views for data relationships display)
- Single controller for all
- Single views for all
- Unit testing / module testing
- Handling of special cases / database records with relationships

## Contributing
For any contribution just fork the repository and make a pull request once your change / feature is complete. Please provide details of the change / feature and test /QA guide on your pull request. Credit / mention will be added to contributors.

## Usage
1. Create branch for new module
2. php artisan make:controller "Admin/<SingularFormOfClass>Controller" eg: php artisan make:controller "Admin/PaymentStatusController" (do not use --resource command for we will copy and paste existing controller content)
3. php artisan make:controller "Models/<SingularFormOfTableName>" -m eg: php artisan make:model "Models/PaymentStatus" -m
4. php artisan make:seeder "<PluralFormOfTableName>TableSeeder" eg: php artisan make:seeder "PaymentStatusesTableSeeder"
5. Now populate the needed files for your module, the steps are carried out as my prefered order due to the use/need of the data per file for easy copy and paste of data. Also you can copy and paste existing file contents from the same files and just update the content with your needed data
6. First setup your database migration file so that you have an ideal or blueprint of the database fields
7. Populate your database seeder next for any test data you will need, dont forget to add the database seeder class on the DatabaseSeeder file
8. Open the model created for the module and copy and paste from existing models properties / attributes and add other fields or properties / attributes you need
9. Add your log type for the module on the LogTypesTableSeeder class
10. Register a route for your module on the web.php file
11. Open the module controller file, copy and paste an existing controller content. Don't forget to update the base controller of the created module to AdminBaseController
12. On the controller file, update the $columns and $fields array accodingly to your database columns. $columns array will be used on your DataTables columns while $fields array will be used for your rules / validation. The key should be your database column field name and the value could be whatever you want.
13. Update the $log_id variable to the predicted / next ID for your log types (usually increment by 1). This will be used to pull the applicable log type for your CRUD actions log message
14. Update the $route_key with the route key value you added on the web.php. This will be used by the controller to map / show your views
15. Update $page_name_singular with the singular form of your module name and $page_name_plural with the plural form of your module name, this will be used on the get_page_name() function which is on the AdminBaseController which is used to pull your needed page title / name
16. Update $database_table_dt and $database_table would be the database table name for the module, the database_table_dt would be used for the displayed columns on the DataTable and $database_table for the database table where the CRUD actions are affecting. There are some instance that I use MySQL database user views for my DataTables display this are usually done with data with relationships to other data and I join them using a database user view and not on the model relationship
17. Update $unique_field with the column name of your unique database field which would be used on displaying notifications for added and update records and also for the delete confirmation dialog box
18. Update the $rules array on the store function with the rules you need for storing your data
19. Update the $rules array on the update function with the rules you need for updating your data
20. Copy an admin module view folder and paste it on the views/admin folder, rename the copied module view folder with the route key you used on the web.php
21. Inside the module view group there would be the index, create, edit and form blade template files, update their file names accodingly:
	- index : <route-key>.blade.php eg: services.blade.php to payment-statuses.php
		- Template file used for the main page of the module
	- create : <route-key>-create.blade.php eg: services-create.blade.php to payment-statuses-create.blade.php
		- Template file used for the record creating page of the module
	- edit : <route-key>-edit.blade.php eg: services-edit.blade.php to payment-statuses-edit.blade.php
		- Template file used for the record updating / editing page of the module
	- form : <route-key>-form.blade.php eg: services-form.blade.php to payment-statuses-form.blade.php
		- Template file loaded by the create and update / edit template for the form fields
22. Update the form blade template file to match your needed form fields
23. Update the main-sidebar.blade.php for the navigation panel change, follow how the nesting and formatting done.
24. Done with the file changes, now load your data using php artisan migrate:refresh --seed
25. Test your new module
	- Navigate to your module view page, check all the DataTables features
	- Create a new entry, input an existing value on your unique field, upon submission the saving should return an error message and won't save the record. Input a non-existing value and proceed with saving it.
	- Edit that newly created record, update the unique field with an existing unique value, trigger the update action, an error message should appear and the update must not carry out. Now update the value with a non-existing unique value and the update should be successful.
	- Delete the test record you created and updated, press the delete button and a confirmation message should appear, click no and nothing should happen. Trigger the deletion again and now select yes, the record should be removed on the DataTables and a confirmation message should appear. Refresh the page and validate that the record is deleted.
26. Once done, push all changes to your repository
 
 ## Disclaimer / Credits
 No copyright violation intended for copyrighted modules and/or contents. Ownership and rights are due for their respective owners. 
  
Laravel Framework  
---  
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:  
  
* [Simple, fast routing engine](https://laravel.com/docs/routing).  
* [Powerful dependency injection container](https://laravel.com/docs/container).  
* Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.  
* Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).  
* Database agnostic [schema migrations](https://laravel.com/docs/migrations).  
* [Robust background job processing](https://laravel.com/docs/queues).  
* [Real-time event broadcasting](https://laravel.com/docs/broadcasting).  
  
Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.  
  
License  
---  
The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Resources / References
- Integrate authentication / login: https://laravel.com/docs/5.3/authentication  
 - Logging class integration: https://tutorials.kode-blog.com/laravel-5-custom-helper  
 - Integrate Laravel Datatables: https://datatables.yajrabox.com/starter / https://github.com/yajra/laravel-datatables  
 - composer require yajra/laravel-datatables-oracle:6.*  
ViewComposerServiceProvider  
 - Login process: http://miftyisbored.com/a-complete-laravel-5-3-tutorial-for-user-authentication-with-activation-email/  
 - [Unique With](https://github.com/felixkiss/uniquewith-validator)  
- Excel Import / Export - http://www.maatwebsite.nl/laravel-excel/docs/getting-started   
- Image from Storage Viewing:  
https://stackoverflow.com/questions/30191330/laravel-5-how-to-access-image-uploaded-in-storage-within-view  
- Forms: http://vegibit.com/create-form-elements-using-laravel-and-bootstrap/  
- Using Bower  - http://stackoverflow.com/questions/38683378/bower-init-command-error-gitbash-in-windows
- [Laravel Snappy](https://github.com/barryvdh/laravel-snappy)
- [Laravel DataTables with Buttons](https://yajrabox.com/docs/laravel-datatables/master/buttons-installation) 