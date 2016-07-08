**Laravel 5.2 MultiAuth**
=========================

This code just implementation multi auth feature Laravel 5.2

 

**Steps of create MultiAuth Laravel 5.2**

-   Edit .env to your database name

`DB_DATABASE=multiauth_example`

`DB_USERNAME=root`

`DB_PASSWORD=`

 

-   Next, edit config/database.php, If you use mysql change your database name like in .env

`'mysql' => [`

`            'driver' => 'mysql',`

`            'host' => env('DB_HOST', 'localhost'),`

`            'port' => env('DB_PORT', '3306'),`

`            'database' => env('DB_DATABASE', 'multiauth_example'),`

`            'username' => env('DB_USERNAME', 'root'),`

`            'password' => env('DB_PASSWORD', ''),`

`            'charset' => 'utf8',`

`            'collation' => 'utf8_unicode_ci',`

`            'prefix' => '',`

`            'strict' => false,`

`            'engine' => null,`

`        ],`

 

-   Create Auth Scaffolding

`php artisan make:auth`

 

-   After finish create scaffolding, edit file config/auth.php

    `'defaults' => [`

    `        'guard' => 'web',`

    `        'passwords' => 'users',`

    `    ],`

 

`    'guards' => [`

`        'web' => [`

`            'driver' => 'session',`

`            'provider' => 'users',`

`        ],`

 

`        'admin' => [`

`            'driver' => 'session',`

`            'provider' => 'admins',`

`        ],`

 

`        'api' => [`

`            'driver' => 'token',`

`            'provider' => 'users',`

`        ],`

`    ],`

 

`    'providers' => [`

`        'users' => [`

`            'driver' => 'eloquent',`

`            'model' => App\User::class,`

`        ],`

`        'admins' => [`

`            'driver' => 'eloquent',`

`            'model' => App\Admin::class,`

`        ],`

 

`    'passwords' => [`

`        'users' => [`

`            'provider' => 'users',`

`            'email' => 'auth.emails.password',`

`            'table' => 'password_resets',`

`            'expire' => 60,`

`        ],`

`    ],`

 

-   Edit file kernel.php on folder app\\Http to add admin on middlewareGroup

    `protected $middlewareGroups = [`

    `        'web' => [`

    `            \App\Http\Middleware\EncryptCookies::class,`

    `            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,`

    `            \Illuminate\Session\Middleware\StartSession::class,`

    `            \Illuminate\View\Middleware\ShareErrorsFromSession::class,`

    `            \App\Http\Middleware\VerifyCsrfToken::class,`

    `        ],`

     

    `        'admin' => [`

    `            \App\Http\Middleware\EncryptCookies::class,`

    `            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,`

    `            \Illuminate\Session\Middleware\StartSession::class,`

    `            \Illuminate\View\Middleware\ShareErrorsFromSession::class,`

    `            \App\Http\Middleware\VerifyCsrfToken::class,`

    `        ],`

     

    `        'api' => [`

    `            'throttle:60,1',`

    `        ],`

    `    ];`

 

-   Before next step, create table users with migrations commands

`php artisan migrate`

nb : if you use feature auth scaffolding you have user table on folder database/migrations, with name it 2014\_10\_12\_000000\_create\_users\_table.php and you just type commands syntax in Terminal or Command Prompt

 

-   Now we have table users next create table admins and model Admin with commands

`php artisan make:models Admin -m`

 

-   Edit file create\_admins\_table.php on folder database/migrations

    `public function up()`

    `    {`

    `        Schema::create('admins', function (Blueprint $table) {`

    `            $table->increments('id');`

    `            $table->string('name');`

    `            $table->string('email')->unique();`

    `            $table->string('password');`

    `            $table->rememberToken();`

    `            $table->timestamps();`

    `        });`

    `    }`

     

    `    /**`

    `     * Reverse the migrations.`

    `     *`

    `     * @return void`

    `     */`

    `    public function down()`

    `    {`

    `        Schema::drop('admins');`

    `    }`

 

-   Now, migrate file create\_admins\_table for create table admin on database

`php artisan migrate`

 

-   Create file seeds for table users and admins

`php artisan make:seeder AdminTableSeeder`

`php artisan make:seeder UserTableSeeder`

 

-   Edit file seeds AdminTableSeeder and UserTableSeeder

*AdminTableSeeder.php*

`public function run()`

`    {`

`        //`

`        DB::table('admins')->truncate();`

`        DB::table('admins')->insert([`

`        		'name' => 'admin_Name',`

`        		'email' => 'your_admin@email',`

`        		'password'=>bcrypt('your_password'),`

`        	]);`

`    }`

*UserTableSeeder.php*

`public function run()`

`    {`

`        //`

`        DB::table('users')->truncate();`

`        DB::table('users')->insert([`

`        		'name' => 'user_name',`

`        		'email' => 'your_user@email',`

`        		'password'=>bcrypt('your_password'),`

`        	]);`

`    }`

 

-   Edit file DatabaseSeeder.php on folder database/seed to insert AdminTableSeeder and UserTableSeeder into your database

    `public function run()`

    `    {`

    `        // $this->call(UsersTableSeeder::class);`

    `        $this->call(UserTableSeeder::class);`

    `        $this->call(AdminTableSeeder::class);`

    `    }`

 

-   To inserting data from AdminTableSeeder and UserTableSeeder to database table admins and user, use DatabaseSeeder.php now type command seeder on Terminal or Command Prompt

`php artisan db:seed`

 

-   Next, edit file Admin.php on folder app/ (this file Admin.php content like on file User.php just copying content User.php)

    `<?php`

     

    `namespace App;`

     

    `use Illuminate\Foundation\Auth\User as Authenticatable;`

     

    `class Admin extends Authenticatable`

    `{`

    `    //`

    `    /**`

    `     * The attributes that are mass assignable.`

    `     *`

    `     * @var array`

    `     */`

    `    protected $fillable = [`

    `        'name', 'email', 'password',`

    `    ];`

     

    `    /**`

    `     * The attributes that should be hidden for arrays.`

    `     *`

    `     * @var array`

    `     */`

    `    protected $hidden = [`

    `        'password', 'remember_token',`

    `    ];`

    `}`

 

-   Create Controller AdminController with command

`php artisan make:controller AdminController`

 

-   Edit file AdminController.php on folder app\\http\\Controllers

    `<?php`

     

    `namespace App\Http\Controllers;`

     

    `use Illuminate\Http\Request;`

     

    `use App\Http\Requests;`

    `use App\Http\Controllers\Controller;`

    `use Auth;`

     

    `class AdminController extends Controller`

    `{ `

    `    //`

    `    public function __construct(){`

    `    	// $this->middleware('auth');`

    `    }`

     

    `    public function index(){`

    `    	return view ('admin.index');`

    `    }`

     

    `    public function login(){`

    `    	return view('auth.login');`

    `    }`

     

    `    public function postLogin(Request $request){`

    `    	`

    `    	`

    `    	$validator = validator($request->all(),[`

    `    			'email' => 'required|min:3|max:100',`

    `    			'password' => 'required|min:3|max:100',`

    `    		]);`

    `    	`

    `    	if ($validator->fails()){`

    `    		return redirect('/login')`

    `    				->withErrors($validator)`

    `    				->withInput();`

    `    	}`

    `    	`

    `    	$credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];`

     

    `    	if ( auth()->guard('admin')->attempt($credentials) ){`

    `    		return redirect('/admin');`

    `    	}else{`

    `    		return redirect('/admin/login')`

    `    			->withErrors(['errors' => 'Login Invalid'])`

    `    			->withInput();`

    `    	}`

    `    }`

     

    `    public function logout(){`

    `    	auth()->guard('admin')->logout();`

     

    `    	return redirect('/login');`

    `    }`

     

    `}`

 

-   Create Controller LoginController with same commands on before steps

`php artisan make:controller LoginController`

 

-   Edit file LoginController on app\\Http\\Controllers

    `<?php`

     

    `namespace App\Http\Controllers;`

     

    `use Illuminate\Http\Request;`

     

    `use App\Http\Requests;`

    `use App\Http\Controllers\Controller;`

     

    `use Auth;`

     

    `class LoginController extends Controller`

    `{`

    `    `

    `    public function Login(){`

    `    	return view('auth.login');`

    `    }`

     

    `    public function testLogin(Request $request){`

    `    	$validator = validator($request->all(),[`

    `    			'email' => 'required|min:5|max:100',`

    `    			'password' => 'required|min:5|max:30',`

    `    		]);`

    `    	if($validator->fails()){`

    `    		return redirect('/login')`

    `    			->withErrors($validator)`

    `    			->withInput();`

    `    	}`

    `    `

    `    	$credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];`

     

    `    	if(auth()->guard('admin')->attempt($credentials)){`

    `    		return redirect('/admin');`

    `	    }else if(auth()->guard('web')->attempt($credentials)){`

    `	    	return redirect ('/home');`

    `	    }else{`

    `	    	return redirect ('/login')`

    `	    		->withErrors(['errors'=> 'Login invallid'])`

    `	    		->withInput();`

    `	    }`

    `    }`

     

     

    `    public function logout(){`

    `    	auth()->guard('web')->logout();`

    `	    	return redirect ('/login');`

    `	}`

    `    `

     

    `}`

 

-   Last Step, edit routes.php on folder app\\Http

    `<?php`

     

    `/*`

    `|--------------------------------------------------------------------------`

    `| Application Routes`

    `|--------------------------------------------------------------------------`

    `|`

    `| Here is where you can register all of the routes for an application.`

    `| It's a breeze. Simply tell Laravel the URIs it should respond to`

    `| and give it the controller to call when that URI is requested.`

    `|`

    `*/`

     

    `Route::group(['middleware' => 'admin'], function(){`

     

    `	Route::group(['middleware' => 'auth:admin'], function(){`

    `		Route::get('/admin', 'AdminController@index');`

    `	});`

    `	// Route::get('/admin', 'AdminController@index');`

     

    `	Route::get('/login', 'LoginController@login');`

    `	Route::post('/login', 'LoginController@testLogin');`

     

    `	Route::get('/admin/logout', 'AdminController@logout');    `

    `});`

     

    `Route::group(['middleware' => 'web'], function(){`

     

    `	// Route::auth();`

     

    `	Route::get('/login', 'LoginController@Login');`

    `	Route::post('/login', 'LoginController@testLogin');`

     

    `	Route::get('/home', 'HomeController@index');`

     

    `	Route::get('/logout', 'LoginController@logout');`

     

    `	Route::get('/', function () {`

    `	    return view('welcome');`

    `	});`

     

    `});`

 

if you have some problem or can’t understanding with my method how to create multi auth on Laravel 5.2 you can download this code. I’m not expert in this laravel code just learn and try to solved problem :D

 

Sorry if my english so bad

 

_Thanks Adhitya Putra_
