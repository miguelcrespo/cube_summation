<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    function setUp()
    {
        @session_start();
        parent::setUp();

    }

    public function testHome()
    {
        $this->visit('/')
            ->see('Comando');

    }

    public function testCreate()
    {

        $this->call('POST', '/', ['m' => '-123123', 'n' => '1']);

        $this->assertResponseStatus(302);

        $this->call('POST', '/', ['m' => '99123123', 'n' => '1']);

        $this->assertResponseStatus(302);

        $this->call('POST', '/', ['m' => '1', 'n' => '-999991']);

        $this->assertResponseStatus(302);

        $this->call('POST', '/', ['m' => '1', 'n' => '9999991']);

        $this->assertResponseStatus(302);

        $this->call('POST', '/', ['m' => '1', 'n' => '2']);

        $this->assertResponseStatus(200);

    }

    public function testUpdate()
    {
       /* $response = $this->call('POST', '/update', ['x' => '1', 'y' => '1', 'z' => '1', 'values' => '2']);

        dd($response);
        $this->assertResponseStatus(302);*/

        //dd($response);

    }



}
