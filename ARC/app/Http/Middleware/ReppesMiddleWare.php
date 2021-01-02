<?php
namespace App\Http\Middleware;

use App\Utility\DbConnect;
use App\Http\Model\AuthModel;
use App\Utility\CustomValidation;
use Carbon\Carbon;
use Closure;
use DB;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class ReppesMiddleWare extends MiddleWare
{
protected $dynamicDB;
protected $validation;

public function __construct(DbConnect $dynamicDB,CustomValidation $validation)
{
 $this->dynamicDB = $dynamicDB;
 $this->validation = $validation;
}

/**
 * Handle an incoming request.
*
* @param  \Illuminate\Http\Request $request
* @param  \Closure                 $next
* @return mixed
*/
public function handle($request, Closure $next,  ...$guards)
{
if($this->dynamicDB->setProperties() == false) {
return response()->json('', config('constants.response_codes.bad_request'));
}
if($this->dynamicDB->setProperties() === "invalid") {
return response()->json('', config('constants.response_codes.db_bad_request'));
}
/**
* Checking request content-type 
* returns error if  content type is not equal to application/json
* with status code 415 - Unsupported media type
*/
if($this->validation->validateContentType($request->header('Content-Type')) == false) {
return response()->json('', config('constants.response_codes.unsupported_media'));
}
/**
* verifying session 
* returns error if the session is invalid with status code 401 - Unauthorized Access
*/
if (config('constants.APP_ENV') == "local") {
$request->session()->put('IsSessionValid', false);
}
if(!$request->session()->has('IsSessionValid')) {
return response()->json('', config('constants.response_codes.unauthorized'));
}
/**
* verifying pid
* returns error if pid is not set in header with status code 401 - Unauthorized Access
*/
if(empty($request->header('Pid'))) {
return response()->json('', config('constants.response_codes.unauthorized'));
}
/**
* check whether pid is in database -if not exist return error with status code 401 - Unauthorized Access 
*/
try{
if(AuthModel::find($request->header('Pid')) == false) {
return response()->json('', config('constants.response_codes.unauthorized'));
}
} // if there is any database exception return internal server error 500
catch(\Exception $ex){
return response()->json('', config('constants.response_codes.internal_error'));
}
return $next($request);
}
}

?>