<?php
include './test_bootstrap.php';

class ScheduleTest extends \PHPUnit_Framework_TestCase
{
    protected $_conn;

    public function setUp()
    {
        $this->_conn = new PDO(
            'pgsql:host=localhost;dbname=ibl_stats', 
            'stats', 
            'st@ts=Fun'
        ); 
    }

    public function tearDown()
    {
        unset($this->_conn);
    }

    public function testGetSchedulesForWeek()
    {
        $mapper = new \IBL\ScheduleMapper($this->_conn);
        $testSchedules = $mapper->generateByWeek(27);
        $this->assertEquals(
            24,
            count($testSchedules),
            "Found correct number of schedules for a week"
        );
        $this->assertEquals(
            true,
            array_key_exists('MAD', $testSchedules),
            "Found MAD in week 27 schedule"
        );
    }
}
