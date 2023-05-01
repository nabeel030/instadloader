<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('extract-url', function(Request $request) {
    $scriptPath = "instadloader.py";

    $url = $request->url;

    $out = exec("/usr/bin/python $scriptPath $url", $output, $returnValue);
    dd($output);

    if (!is_file($scriptPath)) {
        die("Error: Python script not found at $scriptPath");
    }

    try {
        exec("ls", $output, $returnValue);
        // exec("python $scriptPath $url", $output, $returnValue);

        // Check the return value to see if the command was successful
        if ($returnValue === 0) {
            // Command was successful, do something with the output
            echo implode("\n", $output);
        } else {
            // Command failed, handle the error
            echo "Command failed with exit code: $returnValue";
        }
    } catch(\Exception $ex) {
        dd($ex);
    }
    
})->name('extractUrl');
