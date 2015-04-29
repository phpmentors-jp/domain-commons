<?php
namespace PHPMentors\DomainCommons\DateTime;

class YearTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider instanciateData
     */
    public function instanciate($dateStr, $expected)
    {
        $instance = new Year($dateStr);

        $this->assertThat($instance->format('Y-m-d H:i:s'), $this->equalTo($expected));
    }

    public function instanciateData()
    {
        return [
            ['2014-03-21 12:34:55', '2014-01-01 00:00:00'],
        ];
    }
}
