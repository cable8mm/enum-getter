<?php

namespace Cable8mm\EnumGetter;

trait EnumGetter
{
    public function name()
    {
        return $this->value;
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_map(
            function ($value) {
                return $value->name();
            }, self::cases()
        );
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }

    public static function reverse(): array
    {
        return array_combine(self::values(), self::names());
    }
}
