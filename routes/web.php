<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
    
/**
 * Employee routes
 *
 * @author [C.T.Swamy] [<c.thippeswamy@accionlabs.com>]
 * 
 * @return JsonResponse
 */
$router->group(['prefix' => 'api'], function () use ($router){

    $router->post('employees',['uses'=> 'EmployeeController@create']);
    $router->get('employees',['uses'=> 'EmployeeController@showAllEmployees']);
    $router->get('employee/{id}',['uses'=> 'EmployeeController@showOneEmployee']);
    $router->delete('employee/{id}',['uses'=> 'EmployeeController@delete']);

});