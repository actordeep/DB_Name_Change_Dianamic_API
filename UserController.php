<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $newDatabaseName = $request->input('database_name');

        // Update the .env file with the new database name
        File::put(base_path('.env'), str_replace(
            'DB_DATABASE=' . env('DB_DATABASE'),
            'DB_DATABASE=' . $newDatabaseName,
            File::get(base_path('.env'))
        ));

        // Clear the database connection cache
        Artisan::call('config:clear');

        return response()->json(['message' => 'Database name updated successfully']);
    }
}

//database_name pass throw api $request->database_name
