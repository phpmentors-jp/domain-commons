# Domain Commons

Commons for domain models

[![Build Status](https://travis-ci.org/phpmentors-jp/domain-commons.svg?branch=master)](https://travis-ci.org/phpmentors-jp/domain-commons)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/0e1c452e-3cd6-4e17-a6c2-77ae78a9a878/mini.png)](https://insight.sensiolabs.com/projects/0e1c452e-3cd6-4e17-a6c2-77ae78a9a878)
[![Total Downloads](https://poser.pugx.org/phpmentors/domain-commons/downloads.png)](https://packagist.org/packages/phpmentors/domain-commons)
[![Latest Stable Version](https://poser.pugx.org/phpmentors/domain-commons/v/stable.png)](https://packagist.org/packages/phpmentors/domain-commons)
[![Latest Unstable Version](https://poser.pugx.org/phpmentors/domain-commons/v/unstable.png)](https://packagist.org/packages/phpmentors/domain-commons)

# Installation

`Domain Commons` can be installed using  [Composer](http://getcomposer.org/).

CAUTION: dev package is only available.

```
// composer.json
{
    "minimum-stability": "dev"
}

$ composer require phpmentors/domain-commons
```

# Features

## DateTime basics

### Date and Time

- Date
- DateTime
- MonthDay
- Year
- YearMonth
- HourMin

### Period

- Duration
- Period
- Term

#### Traversable

- DailyTrait / DailyIteratableInterface
- MonthlyTrait / MonthlyIteratableInterface

You can define a domain specific period as follows:

```php
namespace MyDomain;

use PHPMentors\DomainCommons\DateTime\Date;
use PHPMentors\DomainCommons\DateTime\Period\DailyIteratableInterface;
use PHPMentors\DomainCommons\DateTime\Period\DailyTrait;

class DailyPeriod extends Period implements DailyIteratableInterface
{
    use DailyTrait;

    public function __construct(Date $start, Date $end)
    {
        parent::__construct($start, $end);
        $this->it = $this->iterate(); // this line enables iterator
    }
}
```

You can iterate this period by date using standard `foreach` statement as follows:

```
use PHPMentors\DomainCommons\DateTime\Date;
use MyDomain\DailyPeriod;

$period = new DailyPeriod(new Date('2015-04-12'), new Date('2015-06-30'));

$count = 0;
foreach ($period as $one) {
    echo $one->format('m/d') . PHP_EOL;
}
```




### Utility

- Clock

## Matrix (Typed and Addressed)

- TypedMatrix
- AddressedMatrix

### Operation

- ZeroableInterface

# Support

If you find a bug or have a question, or want to request a feature, create an issue or pull request for it on [Issues](https://github.com/phpmentors-jp/domain-commons/issues).

# Copyright

Copyright (c) 2015 GOTO Hidenori, All rights reserved.

# License

[The BSD 2-Clause License](http://opensource.org/licenses/BSD-2-Clause)
