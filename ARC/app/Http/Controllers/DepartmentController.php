<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Utility\CustomValidation;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DB;
use App\Http\Model\Dept;

class DepartmentController extends Controller
{
//function for listing existing department data 
public function list(Request $request,CustomValidation $datavalidation)
{
//Data Validation Begins 
$rules = array(
"emp_id"        => array("required" => true, // true if required vaidation is mandatory else false
"datatype"      => "string", // specifies what should be the datatype of the input value from client
"length"        => 10, // specifies the maximum allowed length of the input value from client
"charactertype" => "halfwidthalphanumeric" // specifies the character type of input value from cleint
),
//As of now halfwith alphanumeric, string, half width numbers are supported 
"dept_id"       => array("required" => false,
"datatype"      => "string",
"length"        => 10,
"charactertype" => "halfwidthalphanumeric"),
"dept_name"     => array("required" => false,
"datatype"      => "string",
"length"        => 32,
"charactertype" => "string"),
"dept_level"    => array("required" => false,
"datatype"      => "integer",
"length"        => 2,
"charactertype" => "halfwidthnumbers")
);
$validationresponse = $datavalidation->validate($request->all(), $rules); 
// get reponse from validation
if(!empty($validationresponse)) { 
    // /** return errorlist and end process if response from validation class is not empty */
    return response()->json($validationresponse, config('constants.response_codes.bad_request'));
}
//Data Validation Ends. db processing starts
$query = Dept::select("dept_id", "dept_name", "dept_level", "updated_at")->where("is_active", -1);
if(!empty($request->input("dept_id"))) {
 $query = $query->where("dept_id", $request->input("dept_id"));
}
if(!empty($request->input("dept_name"))) {
 $query = $query->where("dept_name", "like", "%".$request->input("dept_name")."%");
}
$dept_level = $request->input("dept_level");
if(isset($dept_level)) {
 $query = $query->where("dept_level", $request->input("dept_level"));
}

try{
 $resultset["data"] = $query->get()->toArray();
 return response()->json($resultset, config('constants.response_codes.success')); 
// return existing list of department data          
//db processing ends 
}
catch(\Exception $ex){
 return response()->json("", config('constants.response_codes.internal_error')); 
// returns 500 for database exception
}
}
/** function for listing existing department data  ends */
/** function for inserting or updating department data */
public function add(Request $request,CustomValidation $datavalidation)
{
//Data Validation Begins 
$rules = array(
"emp_id"        => array("required" => true, // true if required vaidation is mandatory else false
"datatype"      => "string", // specifies what should be the datatype of the input value from client
"length"        => 10, // specifies the maximum allowed length of the input value from client
"charactertype" => "halfwidthalphanumeric" // specifies the character type of input value from cleint
), 
//As of now halfwith alphanumeric, string, half width numbers are supported 
"dept_id"        => array("required" => true,
"datatype"       => "string",
"length"         => 10,
"charactertype"  => "halfwidthalphanumeric"),
"dept_name"      => array("required" => true,
"datatype"       => "string",
"length"         => 32,
"charactertype"  => "string"),
"dept_name_kana" => array("required" => true,
"datatype"       => "string",
"length"         => 32,
"charactertype"  => "string"),
"nick_name"      => array("required" => true,
"datatype"       => "string","length" => 32,
"charactertype"  => "string"),
"dept_level"     => array("required" => true,
"datatype"       => "integer",
"length"         => 2,
"charactertype" => "halfwidthnumbers")
);
$validationresponse = $datavalidation->validate($request->all(), $rules); 
// get reponse from validation class
if(!empty($validationresponse)) { 
//return errorlist and end process if response from validation class is not empty
 return response()->json($validationresponse, config('constants.response_codes.bad_request'));
}
// Data Validation Ends  
try{
//Database Processig Starts
$resultset = Dept::select("is_active", "updated_at")
->where("dept_id", $request->input('dept_id'))
->get()->toArray();
if(empty($resultset)) { 
// if deptid not exist
$dept = new Dept;
$dept->dept_id        = $request->input('dept_id');
$dept->dept_name      = $request->input('dept_name');
$dept->dept_name_kana = $request->input('dept_name_kana');
$dept->nick_name      = $request->input('nick_name');
$dept->dept_level     = $request->input('dept_level');
$dept->is_profit      = 0;
$dept->is_commitee    = 0;
$dept->is_active      = -1;
$dept->updated_at     = date('Y-m-d H:i:s');
$dept->save();
}
else { 
// if deptid exist
if($resultset[0]['is_active'] == 0) {

    return response()->json(array("errorList"=>array(array("field"=>"is_active",
    "code"=>config('constants.custom_error_codes.is_active_field_error'),
    "message"=>config('constants.custom_error_message.is_active_field_error')))), 
    config('constants.response_codes.bad_request'));

}
if(strtotime($resultset[0]['updated_at']) != strtotime($request->input('updated_at'))) {

    return response()->json(array("errorList"=>array(array("field"=>"updated_at",
    "code"=>config('constants.custom_error_codes.updated_at_field_error'),
    "message"=>config('constants.custom_error_message.updated_at_field_error')))),
    config('constants.response_codes.bad_request'));

}
Dept::where("dept_id", $request->input('dept_id'))->update(
[
"dept_name"      => $request->input('dept_name'),
"dept_name_kana" => $request->input('dept_name_kana'),
"nick_name"      => $request->input('nick_name'),
"dept_level"     => $request->input('dept_level'),
"updated_at"     => date('Y-m-d H:i:s')
]
);
}
//Database processing ends     
}
catch(\Exception $ex){
return response()->json("", config('constants.response_codes.internal_error'));  
// return 500 for database exception
}
return response()->json("", config('constants.response_codes.success'));   
// return 200 if success
}
/* function for inserting or updating department data ends. function for soft deleting department 
*/
public function remove(Request $request,CustomValidation $datavalidation)
{
//Data Validation Begins 
$rules = array(
"emp_id"        => array("required" => true, // true if required vaidation is mandatory else false
"datatype"      => "string", // specifies what should be the datatype of the input value from client
"length"        => 10, // specifies the maximum allowed length of the input value from client
"charactertype" => "halfwidthalphanumeric" // specifies the character type of input value from cleint
), 
/* As of now halfwith alphanumeric, string, half width numbers are supported */
"dept_id"       => array("required" => true,
"datatype"      => "string",
"length"        => 10,
"charactertype" => "halfwidthalphanumeric"),
);
$validationresponse = $datavalidation->validate($request->all(), $rules); 
// get reponse from validation class
if(!empty($validationresponse)) { 
/* return errorlist and end process if response from validation class is not empty */
return response()->json($validationresponse, config('constants.response_codes.bad_request'));
}
// Data Validation Ends 
try{
//Database Processig Starts
$resultset = Dept::select("is_active", "updated_at")->where("dept_id", $request->input('dept_id'))
->get()->toArray();
if(!empty($resultset)) {
if(strtotime($resultset[0]["updated_at"]) != strtotime($request->input('updated_at'))) {

    return response()->json(array("errorList"=>array(array("field"=>"updated_at",
    "code"=>config('constants.custom_error_codes.updated_at_field_error'),
    "message"=>config('constants.custom_error_message.updated_at_field_error')))), 
    config('constants.response_codes.bad_request'));

}
Dept::where("dept_id", $request->input('dept_id'))->update(
[
"is_active" => 0,
"updated_at" => date('Y-m-d H:i:s')
]
);
return response()->json("", config('constants.response_codes.success')); 
// return 200 if success
}
else
{
return response()->json("", config('constants.response_codes.bad_request')); 
// not record in db with given dept_id
}
//Database Processig Ends
}
catch(\Exception $ex){
return response()->json("", config('constants.response_codes.internal_error')); 
// returns 500 for database exception
}
}
// function for soft deleting department ends 
}
?>