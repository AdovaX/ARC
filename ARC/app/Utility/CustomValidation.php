<?php
namespace App\Utility;
class CustomValidation
{
    public function validate($request,$rules)
    {
        $regex = array(
            "halfwidthalphanumeric" => "[a-zA-Z0-9]",
            // "string" => "[一-龯A-Za-z+ ]",
            "string" => "[一-龠]+|[ぁ-ゔ]+|[ァ-ヴー]+|[a-zA-Z0-9]+|[ａ-ｚＡ-Ｚ]+|[々〆〤]",
            "halfwidthnumbers" => "[0-9]"
        );
        $errors = array();
        foreach($rules as $key => $val){
            $temp = array();
            for($i=0;$i<sizeof($val);$i++){
                if(!empty($val["required"]) && $val["required"] == true && empty($request[$key])) {
                    $temp = array("field" => $key,"code" => config('constants.custom_error_codes.required_error'),"message" => config('constants.custom_error_message.required_error'));continue;
                }
                if(isset($request[$key]) && !empty($val["datatype"]) && (gettype($request[$key]) != $val["datatype"])) {
                    $temp = array("field" => $key,"code" => config('constants.custom_error_codes.datatype_error'),"message" => config('constants.custom_error_message.datatype_error'));continue;
                }
                if(isset($request[$key]) && !empty($val["length"]) && strlen(utf8_decode($request[$key])) > $val["length"]) {
                    $temp = array("field" => $key,"code" => config('constants.custom_error_codes.length_error'),"message" => config('constants.custom_error_message.length_error'));continue;
                }
                if(isset($request[$key]) && !empty($val["charactertype"]) && preg_match("/^".$regex[$val["charactertype"]]."+$/", $request[$key]) == false) {
                    $temp = array("field" => $key,"code" => config('constants.custom_error_codes.character_type_error'),"message" => config('constants.custom_error_message.character_type_error'));continue;
                }
            }
            if(!empty($temp)) {
                array_push($errors, $temp);
            }
        }
        $response = array();
        if(!empty($errors)) {
            $response["errorList"] = $errors;
        }
        return $response;
    }

    public function validateContentType($contenttype)
    {
            $contenttype = explode(";", str_replace(' ', '', strtolower($contenttype)));
        if(sizeof($contenttype) != 2) {
            return false;
        }
        if($contenttype[0] != "application/json") {
            return false;
        }
        if($contenttype[1] != "charset=utf-8") {
            return false;
        }
            return true;
    }
}
?>