<?php

namespace Cable8mm\EnumGetter\Tests;

use PHPUnit\Framework\TestCase;

final class EnumGetterTest extends TestCase
{
    public function test_value_property_with_from_method(): void
    {
        $this->assertSame('one', Example::from('one')->value);
        $this->assertSame('two', Example::from('two')->value);
        $this->assertSame('three', Example::from('three')->value);
    }

    public function test_value_property(): void
    {
        $this->assertSame('one', Example::EXAMPLE_1->value);
        $this->assertSame('two', Example::EXAMPLE_2->value);
        $this->assertSame('three', Example::EXAMPLE_3->value);
    }

    public function test_names_method(): void
    {
        $this->assertSame(['EXAMPLE_1', 'EXAMPLE_2', 'EXAMPLE_3'], Example::names());
    }

    public function test_values_method(): void
    {
        $this->assertSame(['one', 'two', 'three'], Example::values());
    }

    public function test_name_property(): void
    {
        $this->assertSame('EXAMPLE_1', TranslatedExample::EXAMPLE_1->name);
        $this->assertSame('EXAMPLE_2', TranslatedExample::EXAMPLE_2->name);
        $this->assertSame('EXAMPLE_3', TranslatedExample::EXAMPLE_3->name);
    }

    public function test_array_method_with_value_named_argument(): void
    {
        $this->assertSame(
            [
                'one' => 'you',
                'two' => 'you',
                'three' => 'you',
            ],
            Example::array(value: 'you'));
    }

    public function test_array_method(): void
    {
        $this->assertSame(
            [
                'one' => 'one',
                'two' => 'two',
                'three' => 'three',
            ],
            Example::array()
        );
    }

    public function test_array_method_with_values(): void
    {
        $this->assertSame(
            [
                'one' => 'ChildClass one',
                'two' => 'ChildClass two',
                'three' => 'ChildClass three',
            ],
            TranslatedExample::array()
        );
    }

    public function test_values_method_with_values(): void
    {
        $this->assertSame([
            'ChildClass one',
            'ChildClass two',
            'ChildClass three',
        ],
            TranslatedExample::values());
    }

    public function test_reverse_method(): void
    {
        $this->assertSame(
            [
                'one' => 'one',
                'two' => 'two',
                'three' => 'three',
            ],
            Example::reverse()
        );
    }

    public function test_reverse_method_with_values(): void
    {
        $this->assertSame(
            [
                'ChildClass one' => 'one',
                'ChildClass two' => 'two',
                'ChildClass three' => 'three',
            ],
            TranslatedExample::reverse()
        );
    }

    public function test_of_method(): void
    {
        $this->assertSame(Example::EXAMPLE_1, Example::of('EXAMPLE_1'));
        $this->assertSame(Example::EXAMPLE_2, Example::of('EXAMPLE_2'));
        $this->assertSame(Example::EXAMPLE_3, Example::of('EXAMPLE_3'));

        $this->assertSame(Example::EXAMPLE_1, Example::from('one'));
        $this->assertSame(Example::EXAMPLE_2, Example::from('two'));
        $this->assertSame(Example::EXAMPLE_3, Example::from('three'));
    }

    public function test_keys_method_with_values(): void
    {
        $this->assertSame(['one', 'two', 'three'], TranslatedExample::keys());
    }

    public function test_keys_method(): void
    {
        $this->assertEquals(['one', 'two', 'three'], Example::keys());
    }
}
