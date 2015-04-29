<?php
namespace PHPMentors\DomainCommons\DateTime;

class HourMinTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider instanciateData
     */
    public function instanciate($dateStr, $expected)
    {
        $instance = new HourMin($dateStr);

        $this->assertThat((string)$instance, $this->equalTo($expected));
    }

    public function instanciateData()
    {
        return [
            ['2014-03-21 12:34:55', '12:34'],
        ];
    }
}
