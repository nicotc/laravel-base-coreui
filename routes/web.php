<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('verified');

//Auth::routes(['verify' => true]);



Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->middleware('verified');


    Route::group(['middleware' => ['role:root']], function () {
        Route::get('/generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');
        Route::get('/field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');
        Route::get('/relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');
        Route::post('/generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');
        Route::post('/generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');
        Route::post('/generator_builder/generate-from-file','\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile')->name('io_generator_builder_generate_from_file');
        Route::resource('roles', 'RolesController');
        Route::resource('permissions', 'PermissionsController');
    });



    Route::resource('users', 'UsersController');


});












Route::get('estructura_tablas', function(){

    $tables = DB::select('SHOW TABLES');
    foreach($tables as $table)
    {
        echo "<h2>".$table->Tables_in_findexam."</h2>";

        $campos  = DB::select('SHOW COLUMNS FROM '.$table->Tables_in_findexam);

        echo "<table>
      <tr>
      <th>Field</th>
      <th>Type</th>
      <th>Null</th>
      <th>Key</th>
      <th>Default</th>
      <th>Extra</th>
      </tr>";

        foreach ($campos as $campo) {
            echo  "<tr>
          <td>".$campo->Field."</td>
          <td>".$campo->Type."</td>
          <td>".$campo->Null."</td>
          <td>".$campo->Key."</td>
          <td>".$campo->Default."</td>
          <td>".$campo->Extra."</td>


          </tr>";
        }

        echo "</table>";

    }

});



Route::get('rutas', function(){
    $app = app();
    $routes = $app->routes->getRoutes();
    // return view ('Admin::routes.index',compact('routes'));

    //view
    echo '<table id="routes-table" class="table table-bordered table-responsive">
           <thead>
                    <tr>
                        <th>uri</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Method</th>
                    </tr>
           </thead>
           <tbody>';
    foreach ($routes as $route) {
        echo '<tr>
                            <td>'.$route->uri.'</td>
                            <td>'.$route->getName().'</td>
                            <td>'.$route->getPrefix().'</td>
                            <td>'.$route->getActionMethod().'</td>
                        </tr>';
    }
    echo '</tbody>
    </table>';
});


