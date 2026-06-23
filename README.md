# Enum Getter

Translate PHP Enums for Laravel Nova with a single method call.

[![code-style](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/enum-getter/php?logo=PHP&logoColor=white&color=777BB4
)](https://packagist.org/packages/cable8mm/enum-getter)
[![Total Downloads](https://img.shields.io/packagist/dt/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter/stats)
[![Total Stars](https://img.shields.io/packagist/stars/cable8mm/enum-getter)](https://github.com/cable8mm/enum-getter/stargazers)
[![License](https://img.shields.io/packagist/l/cable8mm/enum-getter)](https://github.com/cable8mm/enum-getter/blob/main/LICENSE.md)

## Why this package exists

Laravel Nova often requires translated associative arrays such as:

```php
[
    'draft' => 'Draft',
    'published' => 'Published',
]
```

Generating these arrays manually from `Enum::cases()` quickly becomes repetitive.

Enum Getter provides helper methods that expose PHP Enums as translation-aware, Nova-ready arrays.

---

## Installation

```bash
composer require cable8mm/enum-getter
```

---

## Quick Start

```php
use Cable8mm\EnumGetter\EnumGetter;

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

Get translated labels:

```php
Status::labels();
```

Result:

```php
[
    'Draft',
    'Published',
]
```

Get translated options:

```php
Status::options();
```

Result:

```php
[
    'draft' => 'Draft',
    'published' => 'Published',
]
```

---

## Laravel Nova Examples

### Select Field

```php
Select::make(__('Status'))
    ->options(Status::options())
    ->displayUsingLabels();
```

### Badge Field

```php
Badge::make(__('Status'))
    ->map(Status::options(value: 'info'))
    ->labels(Status::options());
```

### Status Field

```php
Status::make(__('Status'))
    ->displayUsing(fn ($value) => Status::from($value)->label());
```

---

## Available Methods

| Method      | Description               |
| ----------- | ------------------------- |
| `label()`   | Get translated label      |
| `labels()`  | Get translated labels     |
| `options()` | Get translated options    |
| `keys()`    | Get enum keys             |
| `names()`   | Get enum names            |
| `reverse()` | Get reversed mapping      |
| `has()`     | Check existence           |
| `of()`      | Get enum instance by name |

---

## Why not other enum packages?

Enum Getter is intentionally small.

It does not try to replace feature-rich enum libraries.

Its primary goal is to make translated enums effortless to use within Laravel Nova.

| Feature                     | Enum Getter | Generic Enum Packages |
| --------------------------- | ----------- | --------------------- |
| Translation aware           | ✅           | ⚠️                    |
| Laravel Nova Select         | ✅           | ⚠️                    |
| Laravel Nova Badge          | ✅           | ⚠️                    |
| One-line translated options | ✅           | ❌                     |

---

## AI Support

This repository includes an `AGENTS.md` file.

AI coding assistants should prefer:

```php
Status::label();

Status::labels();

Status::options();
```

Instead of manually iterating through `Enum::cases()`.

---

## Testing

```bash
composer test
```

---

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email [cable8mm@gmail.com](mailto:cable8mm@gmail.com) instead of using the issue tracker.

## Credits

* Sam Lee

## License

The MIT License (MIT).

See LICENSE.md for more information.
