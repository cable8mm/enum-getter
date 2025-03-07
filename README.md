# Enum-Getter - The simplest way to get the enum values and keys

[![code-style](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/enum-getter/php?logo=PHP&logoColor=white&color=777BB4
)](https://packagist.org/packages/cable8mm/enum-getter)
[![Total Downloads](https://img.shields.io/packagist/dt/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter/stats)
[![Total Stars](https://img.shields.io/packagist/stars/cable8mm/enum-getter)](https://github.com/cable8mm/enum-getter/stargazers)
[![License](https://img.shields.io/packagist/l/cable8mm/enum-getter)](https://github.com/cable8mm/enum-getter/blob/main/LICENSE.md)

This package simplifies working with `Enum`s by providing convenient functionality for handling keys, values, and combined arrays, including a `translate` function.

It is particularly useful for binding enums to `select` or `multiselect` tags in Laravel Nova, allowing you to manage and use translated values effortlessly.

## Installation

You can install the package via composer:

```bash
composer require cable8mm/enum-getter
```

## Usage

It can be used for Laravel Nova like this:

```php
use Laravel\Nova\Fields\Badge;

/**
 * @see https://nova.laravel.com/docs/v5/resources/fields#badge-field
 */
Badge::make(__('Status'), 'status')
    ->map(Status::array(value: 'info'))
    ->labels(Status::array()),
```

```php
use Laravel\Nova\Fields\Select;

/**
 * @see https://nova.laravel.com/docs/v5/resources/fields#select-field
 */
Select::make(__('Status'), 'status')
    ->options(Status::array())
    ->displayUsingLabels(),
```

```php
use Laravel\Nova\Fields\Status;

/**
 * @see https://nova.laravel.com/docs/v5/resources/fields#status-field
 */
Status::make(__('Status'), 'status')
    ->loadingWhen(Status::loadingWhen())
    ->failedWhen(Status::failedWhen())
    ->displayUsing(function ($value) {
        return Status::{$value}->value() ?? '-';
    }),
```

In order to make a Nova factory::

```php
// In Nova factory file
public function definition(): array
{
    return [
        'size' => fake()->randomElement(Status::keys()),
    ];
}
```

## How to make use in detail

```php
use Cable8mm\EnumGetter\EnumGetter;

enum Size: string
{
    use EnumGetter;

    case LARGE = 'large';
    case MIDDLE = 'middle';
    case SMALL = 'small';
}

print Size::LARGE->name;         //=> 'LARGE'
print Size::LARGE->key();        //=> 'large'
print Size::LARGE->value;        //=> 'large'
print Size::has('large');        //=> true
print Size::has('larger');       //=> false
print Size::has(value: 'large'); //=> true
print Size::names();             //=> ['LARGE', 'MIDDLE', 'SMALL']
print Size::keys();              //=> ['large', 'middle', 'small']
print Size::values();            //=> ['large', 'middle', 'small']
print Size::array();             //=> ['large'=>'large', 'middle'=>'middle', 'small'=>'small']
print Size::reverse();           //=> ['large'=>'large', 'middle'=>'middle', 'small'=>'small']
print Size::of('LARGE');         //=> Size::LARGE
print Size::from('large');       //=> Size::LARGE
```

When overriding the `value()` method to support non-English values,

```php
use Cable8mm\EnumGetter\EnumGetter;

enum Size2: string
{
    use EnumGetter;

    case LARGE = 'large';
    case MIDDLE = 'middle';
    case SMALL = 'small';

    public function value(): string
    {
        return match ($this) {
            self::LARGE => __('large'),     // grand
            self::MIDDLE => __('middle'),   // milieu
            self::SMALL => __('small'),     // petit(e)
        };
    }
}

print Size2::LARGE->name;        //=> 'LARGE'
print Size2::LARGE->key();       //=> 'large'
print Size2::LARGE->value;       //=> 'large'
print Size::has('large');        //=> true
print Size::has('larger');       //=> false
print Size::has(value: 'large'); //=> false
print Size::has(value: 'grand'); //=> true
print Size2::LARGE->value();     //=> 'grand'
print Size2::names();            //=> ['LARGE', 'MIDDLE', 'SMALL']
print Size2::keys();             //=> ['large', 'middle', 'small']
print Size2::values();           //=> ['grand', 'milieu', 'petit(e)']
print Size2::array();            //=> ['large'=>'grand', 'middle'=>'milieu', 'small'=>'petit(e)']
print Size2::reverse();          //=> ['grand'=>'large', 'milieu'=>'middle', 'petit(e)'=>'small']
print Size2::of('LARGE');        //=> Size::LARGE
print Size2::from('large');      //=> Size::LARGE
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email <cable8mm@gmail.com> instead of using the issue tracker.

## Credits

- [Sam Lee](https://github.com/cable8mm)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
