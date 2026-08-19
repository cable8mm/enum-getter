# Enum Getter

Translate PHP Enums for Laravel Nova with a single method call.

[![code-style](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/enum-getter/php?logo=PHP&logoColor=white&color=777BB4)](https://packagist.org/packages/cable8mm/enum-getter)
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

## Quick Start (Without Translation)

If you don't need translation, simply use the `EnumGetter` trait. The `label()` method returns the enum value as-is, so `keys()` and `labels()` produce the same result.

```php
use Cable8mm\EnumGetter\EnumGetter;

enum Status: string
{
    use EnumGetter;

    case Draft = 'draft';
    case Published = 'published';
}
```

Get enum keys:

```php
Status::keys();
```

Result:

```php
[
    'draft',
    'published',
]
```

Get labels (same as keys when no translation is needed):

```php
Status::labels();
```

Result:

```php
[
    'draft',
    'published',
]
```

> **Note:** Without overriding `label()`, `keys()` and `labels()` return the same values. This is the simplest usage — no translation required.

Get options:

```php
Status::options();
```

Result:

```php
[
    'draft' => 'draft',
    'published' => 'published',
]
```

---

## Quick Start (With Translation)

When you need translated labels (e.g., Korean, English, etc.), override the `label()` method. The `keys()` method always returns the original enum values, while `labels()` returns the translated strings.

```php
use Cable8mm\EnumGetter\EnumGetter;

enum Status: string
{
    use EnumGetter;

    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return __($this->value);
    }
}
```

Get enum keys (original values, unchanged):

```php
Status::keys();
```

Result:

```php
[
    'draft',
    'published',
]
```

Get translated labels:

```php
Status::labels();
```

Result:

```php
[
    '초안',
    '출판됨',
]
```

> **Note:** In this package, "keys" refer to the actual enum values (used as identifiers), while "labels" are the translated display names. For example:
>
> - `keys()` returns: `['draft', 'published']` (used as identifiers)
> - `labels()` returns: `['초안', '출판됨']` (displayed to users)

Get translated options:

```php
Status::options();
```

Result:

```php
[
    'draft' => '초안',
    'published' => '출판됨',
]
```

---

## Understanding `key()` vs `label()`

These two methods serve different purposes:

- **`key()`** — Returns the enum's **value** (the identifier). This is used for data storage, routing, database lookups, etc. It never changes regardless of language.
- **`label()`** — Returns the **display text** for the user. This is where translation happens. Override this method to return localized strings.

### Example

```php
// key() always returns the original value
Status::Draft->key();       // 'draft'
Status::Published->key();   // 'published'

// label() returns the translated display text
Status::Draft->label();     // 'Draft' (or '초안' in Korean)
Status::Published->label(); // 'Published' (or '발표됨' in Korean)
```

### Why are they separate?

Separating `key()` and `label()` follows the **single responsibility principle**:

- The **key** is a stable identifier that should never change — it's used in databases, APIs, and routing.
- The **label** is a presentation concern — it can change based on language, context, or UI requirements.

By keeping them separate, you can change translations without touching the underlying data model.

---

## Get a Random Enum Instance

```php
Status::random();
```

Result:

```php
Status::Draft
```

Get a random enum key:

```php
Status::random()->key();
```

Result:

```php
'draft'
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

Using the `Status` enum from the Quick Start examples:

```php
enum Status: string
{
    use EnumGetter;

    case Draft = 'draft';
    case Published = 'published';

    public function label(): string
    {
        return __($this->value);
    }
}
```

| Method      | Description                                     | Example Call             | Example Output                                 |
| ----------- | ----------------------------------------------- | ------------------------ | ---------------------------------------------- |
| `name()`    | Get enum case name                              | `Status::Draft->name()`  | `'Draft'`                                      |
| `key()`     | Get enum key (value) — the identifier           | `Status::Draft->key()`   | `'draft'`                                      |
| `label()`   | Get translated label — override for translation | `Status::Draft->label()` | `'초안'`                                       |
| `names()`   | Get enum case names                             | `Status::names()`        | `['Draft', 'Published']`                       |
| `keys()`    | Get enum keys (values)                          | `Status::keys()`         | `['draft', 'published']`                       |
| `labels()`  | Get translated labels                           | `Status::labels()`       | `['초안', '출판됨']`                           |
| `options()` | Get translated options (key => label)           | `Status::options()`      | `['draft' => '초안', 'published' => '출판됨']` |
| `reverse()` | Get reversed mapping (label => key)             | `Status::reverse()`      | `['초안' => 'draft', '출판됨' => 'published']` |
| `has()`     | Check existence                                 | `Status::has('draft')`   | `true`                                         |
| `of()`      | Get enum instance by name                       | `Status::of('Draft')`    | `Status::Draft`                                |
| `random()`  | Get a random enum instance                      | `Status::random()`       | `Status::Draft`                                |

### PHP Built-in Enum Methods

In addition to the methods provided by `EnumGetter`, PHP enums have built-in methods that work seamlessly with this package:

| Method      | Description                           | Example Call                 | Example Output                       |
| ----------- | ------------------------------------- | ---------------------------- | ------------------------------------ |
| `from()`    | Get enum instance by value            | `Status::from('draft')`      | `Status::Draft`                      |
| `tryFrom()` | Get enum instance by value (nullable) | `Status::tryFrom('draft')`   | `Status::Draft`                      |
| `tryFrom()` | Returns null if value doesn't exist   | `Status::tryFrom('unknown')` | `null`                               |
| `cases()`   | Get all enum cases                    | `Status::cases()`            | `[Status::Draft, Status::Published]` |

---

## Why not other enum packages?

Enum Getter is intentionally small.

It does not try to replace feature-rich enum libraries.

Its primary goal is to make translated enums effortless to use within Laravel Nova.

| Feature                     | Enum Getter | Generic Enum Packages |
| --------------------------- | ----------- | --------------------- |
| Translation aware           | ✅          | ⚠️                    |
| Laravel Nova Select         | ✅          | ⚠️                    |
| Laravel Nova Badge          | ✅          | ⚠️                    |
| One-line translated options | ✅          | ❌                    |

---

## AI Support

AI coding assistants should prefer:

```php
Status::label();

Status::labels();

Status::options();

Status::random();
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

- Sam Lee

## License

The MIT License (MIT).

See LICENSE.md for more information.
