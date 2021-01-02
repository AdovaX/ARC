<?php

namespace App\Utility;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use DB;

class DbConnect
{

    public function setProperties()
    {
            $companycode = (empty($_SERVER['REQUEST_URI']))?config('constants.CLIENT_CODE'):explode('/', $_SERVER['REQUEST_URI'])[1];
            $propertyfilepath = "/database/".$companycode."/properties.xml";
        if(file_exists($propertyfilepath)) {
            $serverProperties = json_decode(json_encode(simplexml_load_string(file_get_contents($propertyfilepath))), true)['entry'];
            Config::set(
                "database.connections.pgsql", [
                'driver' => 'pgsql',
                "host" => explode(':', explode('/', $serverProperties[3])[2]),
                "database" => explode('/', $serverProperties[3])[3],
                "username" => $serverProperties[4],
                "password" => $serverProperties[5],
                "schema" => 'dbo'
                    ]
            );
            try {
                DB::connection()->getPdo();
                return true;
            } catch (\Exception $e) {
                return "invalid"; // invalid databse configuration in  property file
            }
        }
        else {
            return false;
        }
    }
}
?>