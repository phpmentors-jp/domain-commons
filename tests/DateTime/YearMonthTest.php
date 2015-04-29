<?php
namespace PHPMentors\DomainCommons\DateTime;

class YearMonthTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider instanciateData
     */
    public function instanciate($dateStr, $expected)
    {
        $instance = new YearMonth($dateStr);

        $this->assertThat((string)$instance, $this->equalTo($expected));
    }

    public function instanciateData()
    {
        return [
            ['2014-03-21 12:34:55', '2014-03'],
        ];
    }
}
