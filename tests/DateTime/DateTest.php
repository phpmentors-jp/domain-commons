<?php
namespace PHPMentors\DomainCommons\DateTime;

class DateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider instanciateData
     */
    public function instanciate($dateStr, $expected)
    {
        $instance = new Date($dateStr);

        $this->assertThat($instance->format('Y-m-d H:i:s'), $this->equalTo($expected));
    }

    public function instanciateData()
    {
        return [
            ['2014-03-21 12:34:55', '2014-03-21 00:00:00'],
        ];
    }
}
