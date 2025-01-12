<?php

namespace Cable8mm\EnumGetter\Tests;

use Cable8mm\EnumGetter\EnumGetter;

enum Example: string
{
    use EnumGetter;

    case EXAMPLE_1 = 'one';
    case EXAMPLE_2 = 'two';
    case EXAMPLE_3 = 'three';
}
