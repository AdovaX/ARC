<?php

namespace Tests\Unit;

use App\Utility\DbConnect;
use App\Http\Middleware\ReppesMiddleWare;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Session\NullSessionHandler;
use Mockery;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;
use DB;

/**AUTHOR - MUHAMMED ASLAM
 * @covers \App\Http\Middleware\ReppesMiddleWare
 */

class ReppesMiddleWareTest extends TestCase
{
     
     /**
     *Dynamic DB Connection Mock
     */
    public $dynamicDB;

    /**
     * validation mock
     */
    public $validation;

    /**
     * HTTP Request Mock
     */
    public $request;

    /**
     * Session Hanler
     */
    public $session_handler;

    /**
     *Valid  Session
     */
    public $session;

    public function setUp(): void
    {
        parent::setUp();
        $this->dynamicDB = $this->mocker('App\Utility\DbConnect');
        $this->validation = $this->mocker('App\Utility\CustomValidation');

        $this->session_handler = new NullSessionHandler();
        $this->session = new Store('OK', $this->session_handler);
        $this->session->put('IsSessionValid', true);

        $this->request = $this->mocker(Request::class);

    }

    protected function mocker($class)
    {
        $this->mock = Mockery::mock($class);
        $this->app->instance($class, $this->mock);
        return $this->mock;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare
     * constructor
     * dbconnect class object assigning
     * returns null
     */
    public function _0000(){
        $mock = $this->getMockBuilder("App\Http\Middleware\ReppesMiddleWare")
          ->disableOriginalConstructor()
          ->getMock();
        $reflectedClass = new \ReflectionClass("App\Http\Middleware\ReppesMiddleWare");
        $constructor = $reflectedClass->getConstructor();
        $response = $constructor->invoke($mock, $this->dynamicDB,$this->validation);
        $this->assertEquals($response, null);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * incorrect property file path check
     * returns error code 400
     */
    public function _0001(){
        config(['constants.CLIENT_CODE' => "REPPES"]);
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(false);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);
        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 400);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * incorrect db properties in property file
     * returns error code 502
     */
    public function _0002(){
        config(['constants.CLIENT_CODE' => "REPPES2P"]);
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn("invalid");

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);
        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 502);
    }



    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * db properties in property file is valid check and move to Content-Type check
     * returns error code 415 - unsupported media type
     */
    public function _0003(){

        config(['constants.CLIENT_CODE' => "REPPES1P"]);
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/xml;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(false);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 415);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check Content-Type is null
     * returns error code 415 - unsupported media type
     */
    public function _0004(){

        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn(null);

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(false);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 415);
    }

     /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check Content-Type is empty
     * returns error code 415 - unsupported media type
     */
    public function _0005(){

        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(false);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 415);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check Content-Type is invalid
     * returns error code 415 - unsupported media type
     */
    public function _0006(){

        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/xml; charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(false);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 415);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check Content-Type is valid ( upper case )
     * returns null
     */
    public function _0007(){

        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("APPLICATION/JSON; CHARSET=UTF-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        $this->request->shouldReceive('session')
            ->andReturn($this->session);
           
        $this->request->shouldReceive('header')
            ->with('Pid')
            ->andReturn(2);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response, null);
    }


     /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check Content-Type is valid ( lower case ) and move to session check
     * returns error code 401 - unauthorized
     */
    public function _0008(){

        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        config(['constants.APP_ENV' => "testing"]);

        $this->sessionNG = new Store('NG', $this->session_handler);
        $this->request->shouldReceive('session')
                ->andReturn($this->sessionNG);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 401);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check session is not existing
     * returns error code 401
     */
    public function _0009(){
 
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);


        config(['constants.APP_ENV' => "testing"]);

        $this->sessionNG = new Store('NG', $this->session_handler);
        $this->request->shouldReceive('session')
            ->andReturn($this->sessionNG);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 401);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check session is existing and move to pid empty check
     * returns error code 401
     */
    public function _0010(){
 
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        config(['constants.APP_ENV' => "testing"]);

        $this->request->shouldReceive('session')
            ->andReturn($this->session);

        $this->request->shouldReceive('header')
            ->with('Pid')
            ->andReturn("");

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 401);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check pid is empty
     * returns error code 401
     */
    public function _0011(){
 
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        $this->request->shouldReceive('session')
            ->andReturn($this->session);
           
        $this->request->shouldReceive('header')
            ->with('Pid')
            ->andReturn("");

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 401);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * invalid pid check
     * returns error code 401
     */
    public function _0012(){
 
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        $this->request->shouldReceive('session')
            ->andReturn($this->session);
           
        $this->request->shouldReceive('header')
            ->with('Pid')
            ->andReturn(10);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 401);
    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * check for query exceptiion
     * returns error code 500
     */
    public function _0013(){
 
        config(['database.connections.testing_db.username' => 'admin1']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');

        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        $this->request->shouldReceive('session')
            ->andReturn($this->session);
           
        $this->request->shouldReceive('header')
            ->with('Pid')
            ->andReturn(10);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response->getStatusCode(), 500);

        config(['database.connections.testing_db.username' => 'admin']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');

    }

    /**
     * @test
     * @covers App\Http\Middleware\ReppesMiddleWare::handle
     * if every conditions are valid
     * returns null
     */
    public function _0014(){
 
        $this->dynamicDB
            ->shouldReceive('setProperties')
            ->andReturn(true);

        $this->request->shouldReceive('header')
            ->with('Content-Type')
            ->andReturn("application/json;charset=utf-8");

        $this->validation->shouldReceive('validateContentType')
            ->andReturn(true);

        $this->request->shouldReceive('session')
            ->andReturn($this->session);
           
        $this->request->shouldReceive('header')
            ->with('Pid')
            ->andReturn(2);

        $middleware = new ReppesMiddleWare($this->dynamicDB,$this->validation);

        $response = $middleware->handle($this->request, function () {
        });
        $this->assertEquals($response, null);
        
    }

}
