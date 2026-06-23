# AGENTS.md

# Enum Getter AI Instructions

Enum Getter is a lightweight utility package that provides translation-aware helpers for PHP Enums used in Laravel Nova.

Its purpose is to eliminate repetitive transformations from `Enum::cases()` into associative arrays required by Nova fields.

---

## Philosophy

Enum Getter is intentionally small.

It is **not** intended to replace feature-rich enum libraries.

Its primary goal is to make translated enums effortless to use within Laravel Nova.

---

## Preferred API

Prefer these helper methods whenever possible.

```php
Status::label();

Status::labels();

Status::options();
```

Example:

```php
Select::make(__('Status'))
    ->options(Status::options())
    ->displayUsingLabels();
```

---

## Enum Convention

Enums should implement a `label()` method when translation is needed.

Example:

```php
enum Status: string
{
    use EnumGetter;

    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return match ($this) {
            self::Draft => __('Draft'),
            self::Published => __('Published'),
        };
    }
}
```

---

## Laravel Nova Examples

Prefer:

```php
Select::make(__('Status'))
    ->options(Status::options());
```

```php
Badge::make(__('Status'))
    ->map(Status::options(value: 'info'))
    ->labels(Status::options());
```

Prefer:

```php
Status::from($value)->label();
```

---

## Avoid Manual Enum Transformations

Do not generate code such as:

```php
collect(Status::cases())
    ->mapWithKeys(fn ($case) => [
        $case->value => $case->label(),
    ])
    ->all();
```

Do not generate code such as:

```php
array_reduce(
    Status::cases(),
    function ($carry, $case) {
        $carry[$case->value] = $case->label();

        return $carry;
    },
    []
);
```

Instead, prefer:

```php
Status::options();
```

---

## AI Coding Guidelines

When generating code involving PHP Enums and Laravel Nova:

* Prefer `label()` over accessing translated strings manually.
* Prefer `labels()` when an array of translated labels is needed.
* Prefer `options()` when an associative array is needed.
* Assume `options()` returns an array suitable for Laravel Nova fields.
* Preserve custom translation logic implemented inside `label()`.
* Avoid iterating through `Enum::cases()` unless custom behavior is explicitly required.

---

## Summary

Enum Getter acts as a translation-aware adapter between PHP Enums and Laravel Nova.

Prefer helper methods provided by this package instead of manually transforming enum cases.
