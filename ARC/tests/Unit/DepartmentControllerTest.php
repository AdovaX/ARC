<?php

namespace Tests\Unit;

use App\Http\Model\Dept;
use DB;
use Tests\TestCase;

/**AUTHOR - MUHAMMED ASLAM
 * @covers \App\Http\Controllers\DepartmentController
 */

class DepartmentControllerTest extends TestCase
{   

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * validating request method
     * returns 405
     */
    public function _0075(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"",
            "dept_id"=>1001,
            "dept_name"=>"test-department",
            "dept_level"=>100,
        ];
        $this->json("GET",'/REPPES1P/v1/dept', $data)
        ->assertStatus(405);
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * validating client data
     * returns status code 400
     */
    public function _0076(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"",
            "dept_id"=>1001,
            "dept_name"=>"test-department",
            "dept_level"=>100,
        ];
        $this->json("POST",'/REPPES1P/v1/dept', $data)
                    ->assertStatus(400);
    }

     /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * validating data passed to listing api
     * returns errorList
     */
    public function _0077(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"",
            "dept_id"=>1001,
            "dept_name"=>"+",
            "dept_level"=>100,
        ];
        $expected = ["errorList" => [
            ["field" => "emp_id","code" => "10011","message" => "必須エラー"],
            ["field" => "dept_id","code" => "10012","message" => "型エラー"],
            ["field" => "dept_name","code" => "10014","message" => "文字種エラー"],
            ["field" => "dept_level","code" => "10013","message" => "桁数エラー"],
        ]];
        $this->json("POST",'/REPPES1P/v1/dept', $data)
                    ->assertJson($expected);
    }

     /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * department data listing exception check
     * returns status code 500
     */
    public function _0078(){
        $this->withoutMiddleware();

        config(['database.connections.testing_db.username' => 'admin1']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');

        $data = [
            "emp_id"=>"1001",
            "dept_id"=>"0001",
            "dept_name"=>"事業推進室",
            "dept_level"=>10,
        ];
        $this->json("POST",'/REPPES1P/v1/dept', $data)
                    ->assertStatus(500);

        config(['database.connections.testing_db.username' => 'admin']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * checking response status
     * returns status code 200
     */
    public function _0079(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1001",
            "dept_id"=>"0001",
            "dept_name"=>"事業推進室",
            "dept_level"=>10,
        ];
        $this->json("POST",'/REPPES1P/v1/dept', $data)
                    ->assertStatus(200);
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * response data json format check
     * return list of department data
     */
    public function _0080(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1001",
            "dept_id"=>"0001",
            "dept_name"=>"事業推進室",
            "dept_level"=>10,
        ];
        $this->json("POST",'/REPPES1P/v1/dept', $data)
                    ->assertJsonStructure(["data"=>["*"=>["dept_id","dept_name","dept_level","updated_at"]]]);
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::list
     * response data json check
     * return list of department data
     */
    public function _0081(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1001",
            "dept_id"=>"0060",
            "dept_name"=>"事業推進室",
            "dept_level"=>10,
        ];
        $this->json("POST",'/REPPES1P/v1/dept', $data)
                    ->assertJsonStructure(["data"=>["*"=>[]]]);
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * validating client data
     * return status code 400
     */
    public function _0082(){
        $this->withoutMiddleware();
        $deptid = "0050";
        $data = [
            "emp_id"=>"1000345345345435",
            "dept_id"=>$deptid,
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>10,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
        ->assertStatus(400);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * validating data passed to registration api
     * returns errorList
     */
    public function _0083(){
        $this->withoutMiddleware();
        $deptid = 050;
        $data = [
            "emp_id"=>"",
            "dept_id"=>$deptid,
            "dept_name"=>"test department indocosmo systems private limited",
            "dept_name_kana"=>"+",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $expected = ["errorList" => [
            ["field" => "emp_id","code" => "10011","message" => "必須エラー"],
            ["field" => "dept_id","code" => "10012","message" => "型エラー"],
            ["field" => "dept_name","code" => "10013","message" => "桁数エラー"],
            ["field" => "dept_name_kana","code" => "10014","message" => "文字種エラー"],
        ]];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
        ->assertJson($expected);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * registration api database exception check
     * returns errorList
     */
    public function _0084(){
        $this->withoutMiddleware();

        config(['database.connections.testing_db.username'=>'admin1']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');

        $deptid = "0050";
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>$deptid,
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
            ->assertStatus(500);

        config(['database.connections.testing_db.username'=>'admin']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * department registration insertion status check
     * return status code 200
     */
     public function _0085(){
        $this->withoutMiddleware();
        $deptid = "0050";
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>$deptid,
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
            ->assertStatus(200);

        Dept::where('dept_id',"0050")->delete();
    } 
    

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * department registration existing record fetch error status check
     * returns error code 400
     */
    public function _0086(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0048",
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>"2020-12-07 09:52:35"
        ];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
            ->assertStatus(400);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * department registration existing record valid check
     * returns errorList
     */
    public function _0087(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0048",
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $expected = ["errorList" => [
            ["field" => "is_active","code" => "10015","message" => "有効フラグエラー"]
        ]];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
        ->assertJson($expected);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * department registration existing record last updated datetime check
     * return errorList
     */
    public function _0088(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0049",
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>"2020-12-07 09:52:00"
        ];
        $expected = ["errorList" => [
            ["field" => "updated_at","code" => "10016","message" => "更新日時エラー"]
        ]];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
        ->assertJson($expected);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::add
     * department registration existing record updation status check
     * return status code 200
     */

    public function _0089(){
        $this->withoutMiddleware();
        $updated_at="2020-12-07 09:52:02";
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0049",
            "dept_name"=>"test dept",
            "dept_name_kana"=>"test dept",
            "nick_name"=>"test dept",
            "dept_level"=>20,
            "updated_at"=>$updated_at
        ];
        $this->json("PUT",'/REPPES1P/v1/dept', $data)
            ->assertStatus(200);
        Dept::where('dept_id',"0049")->update(['updated_at'=>$updated_at]);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::remove
     * validating client data
     * return status code 400
     */
    public function _0090(){
        $this->withoutMiddleware();
        $deptid = 0061;
        $data = [
            "emp_id"=>"",
            "dept_id"=>$deptid,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $this->json("DELETE",'/REPPES1P/v1/dept', $data)
        ->assertStatus(400);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::remove
     * validating data passed to deletion api
     * returns errorList
     */
    public function _0091(){
        $this->withoutMiddleware();
        $deptid = 0061;
        $data = [
            "emp_id"=>"",
            "dept_id"=>$deptid,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $expected = ["errorList" => [
            ["field" => "emp_id","code" => "10011","message" => "必須エラー"],
            ["field" => "dept_id","code" => "10012","message" => "型エラー"]
        ]];

        $this->json("DELETE",'/REPPES1P/v1/dept', $data)
        ->assertJson($expected);
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::remove
     * department deletion api database exception check
     * return error status code 500
     */
    public function _0092(){
        $this->withoutMiddleware();

        config(['database.connections.testing_db.username'=>'admin1']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');

        $deptid = "0061";
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>$deptid,
            "updated_at"=>"2020-12-12 05:00:00"
        ];
        $this->json("DELETE",'/REPPES1P/v1/dept', $data)
            ->assertStatus(500);

        config(['database.connections.testing_db.username'=>'admin']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');
    } 

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::remove
     * department deletion existing record fetch error status check
     * returns error code 400
     */
    public function _0093(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0060",
            "updated_at"=>"2020-12-07 09:52:35"
        ];
        $this->json("DELETE",'/REPPES1P/v1/dept', $data)
            ->assertStatus(400);
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::remove
     * department deletion existing record last updated datetime check
     * returns errorlist
     */
    public function _0094(){
        $this->withoutMiddleware();
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0061",
            "updated_at"=>"2020-12-07 09:52:35"
        ];
        $expected = ["errorList" => [
            ["field" => "updated_at","code" => "10016","message" => "更新日時エラー"]
        ]];
        $this->json("DELETE",'/REPPES1P/v1/dept', $data)
        ->assertJson($expected);
    }

    /**
     * @test
     * @covers App\Http\Controllers\DepartmentController::remove
     * department deletion success response status check
     * returns status code 200
     */
    public function _0095(){
        $this->withoutMiddleware();
        $updated_at = "2020-12-07 10:34:39";
        $data = [
            "emp_id"=>"1000",
            "dept_id"=>"0061",
            "updated_at"=>$updated_at
        ];
        $this->json("DELETE",'/REPPES1P/v1/dept', $data)
        ->assertStatus(200);
        Dept::where('dept_id',"0061")->update(['is_active'=>"-1","updated_at"=>$updated_at]);
    }


}
