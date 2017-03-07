# Laravel >= 5.4.*
Getting started with Laravel

Tips: The "$" symbol is a terminal command.

# Starting new project:
 $ composer create-project laravel/laravel project-name "5.4.*"

# Executing project:
$ php artisan serve

# Executing project with open ports (for others access):
$ php artisan serve --host 0.0.0.0 --port 8000

# Documentation:
https://laravel.com/docs/5.4

*PS: If Laravel Commando dont work, go to below tips:
nano ~/.bash_profile
And paste
export PATH=~/.composer/vendor/bin:$PATH
Restart the terminal and enjoy ;)

# Create Auth (login + register):
$ php artisan make:auth

# Create Table Session:
$ php artisan session:table

# Troubleshooting: LARAVEL 5.4 - Erro SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 767 bytes
Solution: Go to: app/Providers/AppServiceProvider.php and insert:
namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
    public function boot()
    {
        Schema::defaultStringLength(191);     
}
*Remove (hard) the table users created and run the migrate command:
$ php artisan migrate

# Troubleshooting: ERROR 1005 / 150 constraint:
Generally, this error occurs when you are trying to create a new table, with a reference in an already existing table.
Make sure the old table is InnoDB (the 2 must be InnoDB), if you do not change
Make sure the collations are the same (utf8, etc ...) SHOW TABLE STATUS WHERE NAME = 'users';
Make sure the old ID field is unsigned (if it is not, in laravel just create it as integer ()
Reset the tables and rotate again.

# Custom Helpers in Laravel:

1) Create the Helpers directory in /app
2) Create the customHelper.php in Helpers directory
3) Into customHelper.php, insert the code like this:
<?php
if(!function_exists('function_name')){
	function function_name(){
		//same code
	}
}

4) Open the composer.json file (on root project) and insert the "file" block:
       "autoload":{
             …
             "psr-4":{
             },
             "files": [
                 "app/Helpers/customHelper.php"
             ]
        }

5) Open the terminal/cmd and type:
 $ composer dump-autoload

# View authorized routes:
 $ php artisan route:list

# Allow RAW QUERY with GROUP BY on DB::select(  DB::raw('select...') ):
config / database.php change the mysql directive  =>
'strict' => false, // FALSE = to use RAW Query, TRUE = secure mode, without RAW Query

# LARAVEL PDF (REPORTS LIKE):
https://github.com/barryvdh/laravel-dompdf

# FORMS HTML LARAVEL:
https://laravelcollective.com/docs/5.3/html
https://packagist.org/packages/laravelcollective/html

# EXCLUSÃO SEGURA (SoftDelete):
In model, insert the trait SoftDeletes ( use SoftDeletes; //into class)
protected $dates = ['deleted_at'];
Create the field deleted_at in migration: $table->softDeletes();

# @COMPONENTS & @SLOT:
	Run in terminal/cmd:
	$ npm install
In the header, insert the css mix href {{mix ('css / app.css')}}
If you use javascript from the bstrap, put in the footer {{mix ('js / app.js')}}
Open terminal and run: npm run dev

Create a directory called components within the view directory:
@component('name-of-file-blade-component')
@slot('title') => into @component, as shipping variable
{{ $title }} (with $) => Variable of receipt of values

NEW MESSAGE FUNCTION ():
$title = 'My title';
$description = 'my description of message';
$next = 'home';
return view('components.mensagem', compact('title', 'description', 'next'));

OTHERS COMPONENTS:
     	     <!-- create bootstrap button to call modal -->
            @component('components.btn-modal')
                @slot('type')
                    success
                @endslot
                @slot('size')
                    sm
                @endslot
                Show Modal
            @endcomponent


            <!-- prepare component modal -->
            @component('components.modal')
                @slot('title')
                    Tytle of window
                @endslot
                @slot('description')
                    Description of modal window with informations
                @endslot
            @endcomponent

            <!-- create alert component, with or without title -->
            @component('components.alert')
                @slot('type')
                    success
                @endslot
                @slot('title')
                    My alert
                @endslot
                Message of alert component
            @endcomponent
