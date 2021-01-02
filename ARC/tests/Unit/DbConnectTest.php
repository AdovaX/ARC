<?php

namespace Tests\Unit;

use App\Utility\DbConnect;
use DB;
use Tests\TestCase;

/**AUTHOR - MUHAMMED ASLA
 * @covers \App\Utility\DbConnect
 */

class DbConnectTest extends TestCase
{

    public $db;

    public function setUp(): void
    {
        parent::setUp();
        $this->db = new DBConnect();
    }


    public function tearDown(): void
    {
        parent::tearDown();
    }
   
    /**
     * @test
     * @covers App\Utility\DbConnect::setProperties
     * check if propertyfile exist or not and if not exist
     * returns false
     */
    public function _0015(){

        config(['constants.CLIENT_CODE' => "REPPES"]);
        $response = $this->db->setProperties();
        $this->assertEquals($response, false);

    }

     /**
     * @test
     * @covers App\Utility\DbConnect::setProperties
     * dbconnection exception check
     * returns true
     */
    public function _0016(){

        config(['database.connections.testing_db.username' => 'admin1']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');

        $response = $this->db->setProperties();
        $this->assertEquals($response, "invalid");

        config(['database.connections.testing_db.username' => 'admin']);
        DB::purge('testing_db');
        DB::reconnect('testing_db');
    }

     /**
     * @test
     * @covers App\Utility\DbConnect::setProperties
     * check if propertyfile exist or not and if exist
     * returns true
     */
    public function _0017(){

        config(['constants.CLIENT_CODE' => "REPPES1P"]);
        $response = $this->db->setProperties();
        $this->assertEquals($response, true);
    }


}
