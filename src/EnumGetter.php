<?php

namespace Cable8mm\EnumGetter;

trait EnumGetter
{
    /**
     * Get name of the enum.
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get the name from the value.
     */
    public static function getName(mixed $value = null): mixed
    {
        if (! is_null($value)) {
            foreach (self::array() as $k => $v) {
                if ($v == $value) {
                    return $k;
                }
            }
        }

        return null;
    }

    /**
     * Get value of the enum.
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
     * Get array of keys and values.
     *
     * @example EnumGetter::array() ['KEY1' => 'VALUE1', 'KEY2' => 'VALUE2', ...]
     * @example EnumGetter::array(value: 'YOU') ['KEY1' => 'YOU', 'KEY2' => 'YOU', ...]
     */
    public static function array(?string $value = null): array
    {
        $values = ! is_null($value) ? array_fill(0, count(self::names()), $value) : self::values();

        return array_combine(self::names(), $values);
    }

    public static function reverse(): array
    {
        return array_combine(self::values(), self::names());
    }
}
