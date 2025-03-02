<?php

namespace Cable8mm\EnumGetter;

trait EnumGetter
{
    /**
     * Get name of the enum.
     *
     * @example self::rab->name()
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
     * @example self::of('rab')
     */
    public static function of(string $name): static
    {
        return self::{$name};
    }

    /**
     * Get value of the enum.
     *
     * @example self::rab->key()
     */
    public function key()
    {
        return $this->value;
    }

    /**
     * Get value of the enum. If translation need to be performed, it will be overriding this method.
     *
     * @example self::rab->value()
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * Get array of names.
     *
     * @example self::names()
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get array of keys.
     *
     * @example self::keys()
     */
    public static function keys(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get array of values to get through `translation` function.
     *
     * @example self::values()
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
     * Check if enum has a specific key or value.
     *
     * @param  ?string  $key  The key of the enum.
     * @param  ?string  $value  The value of the enum.
     * @return bool The method returns true if the enum has the specified key and value, false otherwise.
     *
     * @throws \InvalidArgumentException
     *
     * @example self::has('ko')
     * @example self::has(key: 'ko')
     * @example self::has(value: 'ko')
     */
    public static function has(?string $key = null, ?string $value = null): bool
    {
        if (is_null($key) && is_null($value)) {
            throw new \InvalidArgumentException('The key or value must not be null.');
        }

        if (! is_null($key)) {
            return in_array($key, self::keys());
        }

        return in_array($value, self::values());
    }

    /**
     * Get array of keys and values.
     *
     * @param  ?string  $value  The value of the enum to be filled.
     *
     * @example self::array()
     * @example self::array(value: 'bit_or_rot')
     */
    public static function array(?string $value = null): array
    {
        $values = ! is_null($value) ? array_fill(0, count(self::values()), $value) : self::values();

        return array_combine(self::keys(), $values);
    }

    /**
     * Get reverse array of keys and values.
     *
     * @example self::reverse()
     */
    public static function reverse(): array
    {
        return array_combine(self::values(), self::keys());
    }
}
