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
     * Get enum instance of the enum name property. If the `name` property is a function, it would be needed.
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
    public function key()
    {
        return $this->value;
    }

    /**
     * Get value of the enum. If translation need to be performed, it will be overriding this method.
     *
     * @example case rab = 'bit';
     * @example self::rab->value() => bit
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get array of names.
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
     * Get array of keys.
     *
     * @example case rab = 'bit';
     * @example case car = 'rot';
     * @example self::names => ['rab', 'car']
     */
    public static function keys(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get array of values to get through `translation` function.
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
        $values = ! is_null($value) ? array_fill(0, count(self::values()), $value) : self::values();

        return array_combine(self::keys(), $values);
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
        return array_combine(self::values(), self::keys());
    }
}
