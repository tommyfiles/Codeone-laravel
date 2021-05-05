<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::get('/company-list', function(){
// return ['message'=>'test'];
// });
//Crud
//1 get all (GET)    /api/posts
//2 create a post (POST)   /api/posts
//3 get single  (GET)   /api/post/{id}
//4 update a single  (PUT/PATCH)    /api/posts/{id} 
//5 delete  (DELETE)  /api/posts/{id}



// Route::get('/companies', function(){

//   //update delete   find(1)// using primary key     all()
//       $com =  Company::create([ 'name' =>'Comapnyname2',
//                 'email' => 'email@test.com2',
//                 'logo' => 'companylogolink2',
//                 'catchPhrase'   => 'catchphrasesssss2',
//                 'bs'    =>   'bsvalue2' ]);

//                 return $com;


// });

// Route::get('/companies/all', function(){
// $com = Company::all();
// return $com;
// });


// Route::get('/companies', 'CompanyController@index');
// Route::get('/companies', 'CompanyController@store');
// Route::get('/companies', 'CompanyController@show');
// Route::get('/companies', 'CompanyController@update');
// Route::get('/companies', 'CompanyController@destroy');

//Route::resource('/companies', 'CompanyController');

Route::get('/employeeSeed', 'App\Http\Controllers\EmployeeController@employeeSeeder');
Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);
//Route::get('/employees', 'CompanyController@employeeSeeder');

//apiResource

//to create a resource(posts) in  laravel
//1 create a database migrations
//2 create a model
//2.5 create service? (eloquent)
//3 create  controller to go to info from th database
//4 return info



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
