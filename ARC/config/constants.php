<?php
return [
    'response_codes' => [
        'success' => 200,
        'unauthorized' => 401,
        'internal_error' => 500,
        'bad_request' => 400,
        'db_bad_request' => 502,
        'unsupported_media' => 415,
    ]
    ,
    'custom_error_codes' => [
        'required_error'=> "10011",
        'datatype_error'=> "10012",
        'length_error'=> "10013",
        'character_type_error'=> "10014",
        'is_active_field_error'=> "10015",
        'updated_at_field_error'=> "10016"
    ],
    'custom_error_message' => [
        'required_error' => '必須エラー',
        'datatype_error' => '型エラー',
        'length_error' => '桁数エラー',
        'character_type_error' => '文字種エラー',
        'is_active_field_error'=> "有効フラグエラー",
        'updated_at_field_error'=> "更新日時エラー"
    ],
    'CLIENT_CODE' => 'REPPES1P',
    'APP_ENV' => 'local',
    'contenttype' => 'application/json; Charset=utf-8'
];
?>