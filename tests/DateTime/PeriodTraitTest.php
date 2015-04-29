<?php
namespace PHPMentors\DomainCommons\DateTime;

use PHPMentors\DomainCommons\DateTime\Period\DailyIteratableInterface;
use PHPMentors\DomainCommons\DateTime\Period\DailyTrait;

class DailyPeriod extends Period implements DailyIteratableInterface
{
    use DailyTrait;

    public function __construct($start, $end)
    {
        parent::__construct($start, $end);
        $this->it = $this->iterate();
    }
}

class PeriodTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider dailyPeriodTest
     */
    public function dailyPeriod($start, $end, $expectedCount)
    {
        $period = new DailyPeriod(new Date($start), new Date($end));

        $count = 0;
        foreach ($period as $one) {
            $count++;
        }
        $this->assertThat($count, $this->equalTo($expectedCount));
    }

    public function dailyPeriodTest()
    {
        return [
            ['2015-04-02', '2015-04-05',  4],
            ['2015-04-03', '2015-05-10', 38],
        ];
    }
}
