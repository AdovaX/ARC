<?php

namespace Tests\Unit;

use App\Utility\CustomValidation;
use Tests\TestCase;

/**AUTHOR - MUHAMMED ASLAM
 * @covers \App\Utility\CustomValidation
 */

class CustomValidationTest extends TestCase
{

    public $validation;

    public function setUp(): void
    {
        parent::setUp();
        $this->validation = new CustomValidation();

    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
    
    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter emp_id is empty
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0018(){

        $rules = array(
            "emp_id" =>  array("required" => true)
        );
        $request = [
            "emp_id" => ""
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "emp_id","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter emp_id is null
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0019(){

        $rules = array(
            "emp_id" =>  array("required" => true)
        );
        $request = [
            "emp_id" => null
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "emp_id","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter emp_id is not empty and not null
     * returns empty array
     */
    public function _0020(){

        $rules = array(
            "emp_id" =>  array("required" => true)
        );
        $request = [
            "emp_id" => "1001"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of emp_id is not string
     * returns errorList with code 10012 and message 型エラー
     */
    public function _0021(){

        $rules = array(
            "emp_id" =>  array("datatype" => "string")
        );
        $request = [
            "emp_id" => 10001
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "emp_id","code" => "10012","message" => "型エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of emp_id is string
     * returns empty array
     */
    public function _0022(){

        $rules = array(
            "emp_id" =>  array("datatype" => "string")
        );
        $request = [
            "emp_id" => "10001"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of emp_id is exceeding allowed length 10
     * returns errorList with code 10013 and message 桁数エラー
     */
    public function _0023(){

        $rules = array(
            "emp_id" =>  array("length" => 10)
        );
        $request = [
            "emp_id" => "100110563552232"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "emp_id","code" => "10013","message" => "桁数エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of emp_id is not exceeding allowed length 10
     * returns empty array
     */
    public function _0024(){

        $rules = array(
            "emp_id" =>  array("length" => 10)
        );
        $request = [
            "emp_id" => "10014"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

      /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of emp_id is not halfwidthalphanumeric
     * returns errorList with code 10013 and message 文字種エラー
     */
    public function _0025(){

        $rules = array(
            "emp_id" =>  array("charactertype" => "halfwidthalphanumeric")
        );
        $request = [
            "emp_id" => "1011@"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "emp_id","code" => "10014","message" => "文字種エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of emp_id is halfwidthalphanumeric
     * returns empty array
     */
    public function _0026(){

        $rules = array(
            "emp_id" =>  array("charactertype" => "halfwidthalphanumeric")
        );
        $request = [
            "emp_id" => "1011"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_id is empty
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0027(){

        $rules = array(
            "dept_id" =>  array("required" => true)
        );
        $request = [
            "dept_id" => ""
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_id","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_id is null
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0028(){

        $rules = array(
            "dept_id" =>  array("required" => true)
        );
        $request = [
            "dept_id" => null
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_id","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_id is not empty and not null
     * returns empty array 
     */
    public function _0029(){

        $rules = array(
            "dept_id" =>  array("required" => true)
        );
        $request = [
            "dept_id" => "0000"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

   /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_id is not string
     * returns errorList with code 10012 and message 型エラー
     */
    public function _0030(){

        $rules = array(
            "dept_id" =>  array("datatype" => "string")
        );
        $request = [
            "dept_id" => 0001
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_id","code" => "10012","message" => "型エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_id is string
     * returns empty array
     */
    public function _0031(){

        $rules = array(
            "dept_id" =>  array("datatype" => "string")
        );
        $request = [
            "dept_id" => "0000"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

   /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_id is exceeding allowed length 10
     * returns errorList with code 10013 and message 桁数エラー
     */
    public function _0032(){

        $rules = array(
            "dept_id" =>  array("length" => 10)
        );
        $request = [
            "dept_id" => "000010563552232"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_id","code" => "10013","message" => "桁数エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_id is not exceeding allowed length 10
     * returns empty array
     */
    public function _0033(){

        $rules = array(
            "dept_id" =>  array("length" => 10)
        );
        $request = [
            "dept_id" => "0000"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of dept_id is not halfwidthalphanumeric
     * returns errorList with code 10014 and message 文字種エラー
     */
    public function _0034(){

        $rules = array(
            "dept_id" =>  array("charactertype" => "halfwidthalphanumeric")
        );
        $request = [
            "dept_id" => "0000@"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_id","code" => "10014","message" => "文字種エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of dept_id is halfwidthalphanumeric
     * returns empty array
     */
    public function _0035(){

        $rules = array(
            "dept_id" =>  array("charactertype" => "halfwidthalphanumeric")
        );
        $request = [
            "dept_id" => "0000"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_name is empty
     * returns errorList width code 10011 and message 必須エラー
     */
    public function _0036(){

        $rules = array(
            "dept_name" =>  array("required" => true)
        );
        $request = [
            "dept_name" => ""
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

      /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_name is null
     * returns errorList width code 10011 and message 必須エラー
     */
    public function _0037(){

        $rules = array(
            "dept_name" =>  array("required" => true)
        );
        $request = [
            "dept_name" => null
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_name is not empty and not null
     * returns empty array
     */
    public function _0038(){

        $rules = array(
            "dept_name" =>  array("required" => true)
        );
        $request = [
            "dept_name" => "SS第２グループ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_name is not string
     * returns errorList with code 10012 and message 型エラー
     */
    public function _0039(){

        $rules = array(
            "dept_name" =>  array("datatype" => "string")
        );
        $request = [
            "dept_name" => 10001
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name","code" => "10012","message" => "型エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_name is string
     * returns empty array
     */
    public function _0040(){

        $rules = array(
            "dept_name" =>  array("datatype" => "string")
        );
        $request = [
            "dept_name" => "SS第２グループ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_name is exceeding allowed length 32
     * returns errorList with code 10013 and message 桁数エラー
     */
    public function _0041(){

        $rules = array(
            "dept_name" =>  array("length" => 32)
        );
        $request = [
            "dept_name" => "ソフトウェアソリューションブダイニグループ ( ソフトウェアソリューションブダイニグループ )"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name","code" => "10013","message" => "桁数エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_name is not exceeding allowed length 32
     * returns empty array
     */
    public function _0042(){

        $rules = array(
            "dept_name" =>  array("length" => 32)
        );
        $request = [
            "dept_name" => "ソフトウェアソリューションブダイニグループ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of dept_name is string
     * returns empty array 
     */
    public function _0043(){

        $rules = array(
            "dept_name" =>  array("charactertype" => "string")
        );
        $request = [
            "dept_name" => "ソフトウェアソリューションブダイニグループ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }


  /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_name_kana is empty
     * returns errorList width code 10011 and message 必須エラー
     */
    public function _0044(){

        $rules = array(
            "dept_name_kana" =>  array("required" => true)
        );
        $request = [
            "dept_name_kana" => ""
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name_kana","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_name_kana is null
     * returns errorList width code 10011 and message 必須エラー
     */
    public function _0045(){

        $rules = array(
            "dept_name_kana" =>  array("required" => true)
        );
        $request = [
            "dept_name_kana" => null
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name_kana","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_name_kana is not empty and not null
     * returns empty array
     */
    public function _0046(){

        $rules = array(
            "dept_name_kana" =>  array("required" => true)
        );
        $request = [
            "dept_name_kana" => "システムソリューションジギョウブ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }


      /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_name_kana is not string
     * returns errorList with code 10012 and message 型エラー
     */
    public function _0047(){

        $rules = array(
            "dept_name_kana" =>  array("datatype" => "string")
        );
        $request = [
            "dept_name_kana" => 15235
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_name_kana","code" => "10012","message" => "型エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_name_kana is string
     * returns empty array
     */
    public function _0048(){

        $rules = array(
            "dept_name_kana" =>  array("datatype" => "string")
        );
        $request = [
            "dept_name_kana" => "システムソリューションジギョウブ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_name_kana is exceeding allowed length 32
     * returns errorList with code 10013 and message 桁数エラー
     */
    public function _0049(){

        $rules = array(
            "dept_name_kana" =>  array("length" => 32)
        );
        $request = [
            "dept_name_kana" => "システムソリューションジギョウブ ( システムソリューションジギョウブ )"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
            ["field" => "dept_name_kana","code" => "10013","message" => "桁数エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_name_kana is not exceeding allowed length 32
     * returns empty array
     */
    public function _0050(){

        $rules = array(
            "dept_name_kana" =>  array("length" => 32)
        );
        $request = [
            "dept_name_kana" => "システムソリューションジギョウブ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }
 
    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of dept_name_kana is string
     * returns empty array
     */
    public function _0051(){

        $rules = array(
            "dept_name_kana" =>  array("charactertype" => "string")
        );
        $request = [
            "dept_name_kana" => "012 システムソリューションジギョウブ"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter nick_name is empty
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0052(){

        $rules = array(
            "nick_name" =>  array("required" => true)
        );
        $request = [
            "nick_name" => ""
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "nick_name","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter nick_name is null
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0053(){

        $rules = array(
            "nick_name" =>  array("required" => true)
        );
        $request = [
            "nick_name" => null
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "nick_name","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter nick_name is not empty and not null
     * returns empty array
     */
    public function _0054(){

        $rules = array(
            "nick_name" =>  array("required" => true)
        );
        $request = [
            "nick_name" => "イノベーション"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

       /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of nick_name is not string
     * returns errorList with code 10012 and message 型エラー
     */
    public function _0055(){

        $rules = array(
            "nick_name" =>  array("datatype" => "string")
        );
        $request = [
            "nick_name" => 15235
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "nick_name","code" => "10012","message" => "型エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

      /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of nick_name is string
     * returns empty array
     */
    public function _0056(){

        $rules = array(
            "nick_name" =>  array("datatype" => "string")
        );
        $request = [
            "nick_name" => "イノベーション"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of nick_name is exceeding allowed length 32
     * returns errorList with code 10013 and message 桁数エラー
     */
    public function _0057(){

        $rules = array(
            "nick_name" =>  array("length" => 32)
        );
        $request = [
            "nick_name" => "イノベーション ( イノベーション イノベーション - 20201229)"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "nick_name","code" => "10013","message" => "桁数エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of nick_name is not exceeding allowed length 32
     * returns empty array
     */
    public function _0058(){

        $rules = array(
            "nick_name" =>  array("length" => 32)
        );
        $request = [
            "nick_name" => "イノベーション ( 20201229 )"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }
 
    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of nick_name is string
     * returns empty array
     */
    public function _0059(){

        $rules = array(
            "nick_name" =>  array("charactertype" => "string")
        );
        $request = [
            "nick_name" => "イノベーション ( 20201229 )"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_level is empty
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0060(){

        $rules = array(
            "dept_level" =>  array("required" => true)
        );
        $request = [
            "dept_level" => ""
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_level","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_level is null
     * returns errorList with code 10011 and message 必須エラー
     */
    public function _0061(){

        $rules = array(
            "dept_level" =>  array("required" => true)
        );
        $request = [
            "dept_level" => null
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_level","code" => "10011","message" => "必須エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check required parameter dept_level is not empty and not null
     * returns empty array
     */
    public function _0062(){

        $rules = array(
            "dept_level" =>  array("required" => true)
        );
        $request = [
            "dept_level" => 10
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

      /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_level is not integer
     * returns errorList with code 10012 and message 型エラー
     */
    public function _0063(){

        $rules = array(
            "dept_level" =>  array("datatype" => "integer")
        );
        $request = [
            "dept_level" => "10"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_level","code" => "10012","message" => "型エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check data type of dept_level is integer
     * returns empty array
     */
    public function _0064(){

        $rules = array(
            "dept_level" =>  array("datatype" => "integer")
        );
        $request = [
            "dept_level" => 10
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_level is exceeding allowed length 2
     * returns errorList with code 10013 and message 桁数エラー
     */
    public function _0065(){

        $rules = array(
            "dept_level" =>  array("length" => 2)
        );
        $request = [
            "dept_level" => 123
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_level","code" => "10013","message" => "桁数エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character length of dept_level is not exceeding allowed length 2
     * returns empty array
     */
    public function _0066(){

        $rules = array(
            "dept_level" =>  array("length" => 2)
        );
        $request = [
            "dept_level" => 10
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of dept_level is not halfwidthnumbers
     * returns errorList with code 10014 and message 文字種エラー
     */
    public function _0067(){

        $rules = array(
            "dept_level" =>  array("charactertype" => "halfwidthnumbers")
        );
        $request = [
            "dept_level" => "test-department"
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = ["errorList" => [
                        ["field" => "dept_level","code" => "10014","message" => "文字種エラー"]
        ]];
        $this->assertEquals($expected, $response);

    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validate
     * check character type of dept_level is halfwidthnumbers
     * returns empty array
     */
    public function _0068(){

        $rules = array(
            "dept_level" =>  array("charactertype" => "halfwidthnumbers")
        );
        $request = [
            "dept_level" => 10
        ];
        $response = $this->validation->validate($request,$rules);
        $expected = [];
        $this->assertEquals($expected, $response);

    }


    /**
     * @test
     * @covers App\Utility\CustomValidation::validateContentType
     * check content type is empty
     * returns false
     */
    public function _0069(){
        $response = $this->validation->validateContentType("");
        $this->assertEquals(false, $response);
    }

      /**
     * @test
     * @covers App\Utility\CustomValidation::validateContentType
     * check content type is null
     * returns false
     */
    public function _0070(){
        $response = $this->validation->validateContentType(null);
        $this->assertEquals(false, $response);
    }
    
    /**
     * @test
     * @covers App\Utility\CustomValidation::validateContentType
     * check content type is invalid
     * returns false
     */
    public function _0071(){
        $response = $this->validation->validateContentType("application/xml; charset=utf-8");
        $this->assertEquals(false, $response);
    }

     /**
     * @test
     * @covers App\Utility\CustomValidation::validateContentType
     * check content type is invalid ( contains special character other than semi colon in content-type or charset )
     * returns false
     */
    public function _0072(){
        $response = $this->validation->validateContentType("application/json; charset=utf-8/");
        $this->assertEquals(false, $response);
    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validateContentType
     * check content type is valid ( case sensitivity )
     * returns true
     */
    public function _0073(){
        $response = $this->validation->validateContentType("Application/Json;Charset=utf-8");
        $this->assertEquals(true, $response);
    }

    /**
     * @test
     * @covers App\Utility\CustomValidation::validateContentType
     * check content type is valid ( case sensitivity with white space )
     * returns true
     */
    public function _0074(){
        $response = $this->validation->validateContentType("Application/Json; Charset=utf-8");
        $this->assertEquals(true, $response);
    }

}
