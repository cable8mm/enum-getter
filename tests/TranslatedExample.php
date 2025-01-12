<?php

namespace Cable8mm\EnumGetter\Tests;

use Cable8mm\EnumGetter\EnumGetter;

enum TranslatedExample: string
{
    use EnumGetter;

    case EXAMPLE_1 = 'one';
    case EXAMPLE_2 = 'two';
    case EXAMPLE_3 = 'three';

    public function name()
    {
        return match ($this) {
            self::EXAMPLE_1 => 'ChildClass one',
            self::EXAMPLE_2 => 'ChildClass two',
            self::EXAMPLE_3 => 'ChildClass three',
        };
    }
}
