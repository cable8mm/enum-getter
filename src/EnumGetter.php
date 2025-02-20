<?php

namespace Cable8mm\EnumGetter;

trait EnumGetter
{
    /**
     * Get name of the enum.
     *
     * @example case rab = 'bit';
     * @example self::rab->name() => rab
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * Get the name from the value.
     *
     * @param  mixed  $value  The value of the enum
     * @return string|null The method returns the name of the enum
     *
     * @example case rab = 'bit';
     * @example self::getName('bit') => rab
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
     * Get enum instance of the enum name property
     *
     * @param  string  $name  The enum name property
     * @return static The method returns the enum instance
     *
     * @example case rab = 'bit';
     * @example self::of('rab') => self::rab
     */
    public static function of(string $name): static
    {
        return self::{$name};
    }

    /**
     * Get value of the enum.
     *
     * @example case rab = 'bit';
     * @example self::rab->value() => bit
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get array of keys
     *
     * @example case rab = 'bit';
     * @example case car = 'rot';
     * @example self::names => ['rab', 'car']
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get array of values to get through `translation` function
     *
     * @example case rab = 'bit';
     * @example case car = 'rot';
     * @example public function value()
     * @example {
     * @example     return match ($this) {
     * @example         self::rab => 'Robert',
     * @example         self::car => 'Junior',
     * @example     };
     * @example }
     * @example self::values() => ['Robert', 'Junior']
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
     * @param  ?string  $value  The value of the enum to be filled.
     *
     * @example case rab = 'bit';
     * @example case car = 'rot';
     * @example self::array() ['rab' => 'bit', 'car' => 'rot']
     * @example self::array(value: 'bit_or_rot') ['rab' => 'bit_or_rot', 'car' => 'bit_or_rot']
     */
    public static function array(?string $value = null): array
    {
        $values = ! is_null($value) ? array_fill(0, count(self::names()), $value) : self::values();

        return array_combine(self::names(), $values);
    }

    /**
     * Get reverse array of keys and values.
     *
     * @example case rab = 'bit';
     * @example case car = 'rot';
     * @example self::reverse() ['bit' => 'rab', 'rot' => 'car']
     */
    public static function reverse(): array
    {
        return array_combine(self::values(), self::names());
    }
}
