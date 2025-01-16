<?php

namespace Cable8mm\EnumGetter;

trait EnumGetter
{
    /**
     * Get name of the enum
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get value of the enum
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get array of keys
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get array of values to get through `translation` function
     */
    public static function values(): array
    {
        return array_map(
            function ($value) {
                return $value->value();
            }, self::cases()
        );
    }

    /**
     * Get array of keys and values
     */
    public static function array(): array
    {
        return array_combine(self::names(), self::values());
    }

    public static function reverse(): array
    {
        return array_combine(self::values(), self::names());
    }
}
