# Enum-Getter - The simplest way to get the enum values and keys

[![code-style](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/code-style.yml)
[![run-tests](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/enum-getter/actions/workflows/run-tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter)
[![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/cable8mm/enum-getter/php?logo=PHP&logoColor=white&color=777BB4
)](https://packagist.org/packages/cable8mm/enum-getter)
[![Total Downloads](https://img.shields.io/packagist/dt/cable8mm/enum-getter)](https://packagist.org/packages/cable8mm/enum-getter/stats)
[![Total Stars](https://img.shields.io/packagist/stars/cable8mm/enum-getter)](https://github.com/cable8mm/enum-getter/stargazers)
[![License](https://img.shields.io/packagist/l/cable8mm/enum-getter)](https://github.com/cable8mm/enum-getter/blob/main/LICENSE.md)

This package make `Enum`s simple for making keys, values and combine array including `translate` function.

## Installation

You can install the package via composer:

```bash
composer require cable8mm/enum-getter
```

## Usage

```php
use Cable8mm\EnumGetter\EnumGetter;

enum Size: string
{
    use EnumGetter;

    case LARGE = 'large';
    case MIDDLE = 'middle';
    case SMALL = 'small';
}

print Size::LARGE
//=> 'large'

print Size::LARGE->name()
//=> 'large'

print Size::names()
//=> ['LARGE', 'MIDDLE', 'SMALL']

print Size::values()
//=> ['large', 'middle', 'small']

print Size::array()
//=> ['LARGE'=>'large', 'MIDDLE'=>'middle', 'SMALL'=>'small']

print Size::reverse()
//=> ['large'=>'LARGE', 'middle'=>'MIDDLE', 'small'=>'SMALL']

enum Size2: string
{
    use EnumGetter;

    case LARGE = 'large';
    case MIDDLE = 'middle';
    case SMALL = 'small';

    public function name(): string
    {
        return match ($this) {
            self::LARGE => 'grand', // __('large') can use a translation module
            self::MIDDLE => 'milieu', // __('milieu') can use a translation module
            self::SMALL => 'petit(e)', // __('small') can use a translation module
        };
    }
}

print Size2::LARGE
//=> 'large'

print Size2::LARGE->name()
//=> 'grand'

print Size2::names()
//=> ['LARGE', 'MIDDLE', 'SMALL']

print Size2::values()
//=> ['grand', 'milieu', 'petit(e)']

print Size2::array()
//=> ['LARGE'=>'grand', 'MIDDLE'=>'milieu', 'SMALL'=>'petit(e)']

print Size2::reverse()
//=> ['grand'=>'LARGE', 'milieu'=>'MIDDLE', 'petit(e)'=>'SMALL']
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
