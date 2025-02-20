<?php

namespace Cable8mm\EnumGetter\Tests;

use PHPUnit\Framework\TestCase;

final class EnumGetterTest extends TestCase
{
    public function test_name_method_should_return_name_from_value(): void
    {
        $this->assertSame('EXAMPLE_1', Example::EXAMPLE_1->name());
        $this->assertSame('EXAMPLE_2', Example::getName(value: 'two'));
    }

    public function test_it_should_have_these_key(): void
    {
        $this->assertSame('EXAMPLE_1', Example::EXAMPLE_1->name);
        $this->assertSame('EXAMPLE_2', Example::EXAMPLE_2->name);
        $this->assertSame('EXAMPLE_3', Example::EXAMPLE_3->name);
    }

    public function test_it_should_have_these_keys(): void
    {
        $this->assertContains('EXAMPLE_1', Example::names());
        $this->assertContains('EXAMPLE_2', Example::names());
        $this->assertContains('EXAMPLE_3', Example::names());
    }

    public function test_it_should_have_these_values(): void
    {
        $this->assertContains('one', Example::values());
        $this->assertContains('two', Example::values());
        $this->assertContains('three', Example::values());
    }

    public function test_it_should_have_these_keys_of_child_classes(): void
    {
        $this->assertSame('EXAMPLE_1', TranslatedExample::EXAMPLE_1->name());
        $this->assertSame('EXAMPLE_2', TranslatedExample::EXAMPLE_2->name());
        $this->assertSame('EXAMPLE_3', TranslatedExample::EXAMPLE_3->name());
    }

    public function test_it_should_have_translated_values(): void
    {
        $this->assertContains('ChildClass one', TranslatedExample::values());
        $this->assertContains('ChildClass two', TranslatedExample::values());
        $this->assertContains('ChildClass three', TranslatedExample::values());
    }

    public function test_it_should_have_translated_array(): void
    {
        $this->assertArrayHasKey('EXAMPLE_1', TranslatedExample::array());
        $this->assertArrayHasKey('EXAMPLE_2', TranslatedExample::array());
        $this->assertArrayHasKey('EXAMPLE_3', TranslatedExample::array());

        $this->assertContains('ChildClass one', TranslatedExample::array());
        $this->assertContains('ChildClass two', TranslatedExample::array());
        $this->assertContains('ChildClass three', TranslatedExample::array());
    }

    public function test_it_should_have_array_with_values(): void
    {
        $this->assertEquals(['EXAMPLE_1' => 'you', 'EXAMPLE_2' => 'you', 'EXAMPLE_3' => 'you'], Example::array(value: 'you'));
    }

    public function test_of_method(): Void
    {
        $this->assertSame(Example::EXAMPLE_1, Example::of('EXAMPLE_1'));
        $this->assertSame(Example::EXAMPLE_2, Example::of('EXAMPLE_2'));
        $this->assertSame(Example::EXAMPLE_3, Example::of('EXAMPLE_3'));
    }
}
