<?php

namespace Cable8mm\EnumGetter;

trait EnumGetter
{
    /**
     * Get enum name.
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get enum key.
     */
    public function key(): string|int
    {
        return $this->value;
    }

    /**
     * Get translated label.
     *
     * Override this method when translation is needed.
     */
    public function label(): string
    {
        return (string) $this->value;
    }

    /**
     * @deprecated Use label() instead.
     */
    public function value(): string
    {
        return $this->label();
    }

    /**
     * Get enum instance by name.
     */
    public static function of(string $name): static
    {
        return self::{$name};
    }

    /**
     * Get enum names.
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * Get enum keys.
     */
    public static function keys(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get translated labels.
     */
    public static function labels(): array
    {
        return array_map(
            fn ($case) => $case->label(),
            self::cases(),
        );
    }

    /**
     * @deprecated Use labels() instead.
     */
    public static function values(): array
    {
        return self::labels();
    }

    /**
     * Determine whether enum contains key, label, or case.
     *
     * @throws \InvalidArgumentException
     */
    public static function has(
        string|object|null $key = null,
        ?string $value = null,
    ): bool {
        if ($key === null && $value === null) {
            throw new \InvalidArgumentException(
                'The key or value must not be null.'
            );
        }

        if ($key instanceof \UnitEnum) {
            return in_array($key, self::cases(), true);
        }

        if ($key !== null) {
            return in_array($key, self::keys(), true);
        }

        return in_array($value, self::labels(), true);
    }

    /**
     * Get translated options for Laravel Nova.
     *
     * @example self::options()
     * @example self::options(value: 'info')
     */
    public static function options(?string $value = null): array
    {
        $values = $value === null
            ? self::labels()
            : array_fill(0, count(self::cases()), $value);

        return array_combine(
            self::keys(),
            $values,
        );
    }

    /**
     * @deprecated Use options() instead.
     */
    public static function array(?string $value = null): array
    {
        return self::options($value);
    }

    /**
     * Get reverse mapping.
     */
    public static function reverse(): array
    {
        return array_combine(
            self::labels(),
            self::keys(),
        );
    }
}
