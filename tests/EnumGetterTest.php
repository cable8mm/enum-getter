<?php

namespace Cable8mm\EnumGetter\Tests;

use PHPUnit\Framework\TestCase;

final class EnumGetterTest extends TestCase
{
    public function test_it_should_be_true(): void
    {
        $this->assertTrue(true);
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

    public function test_it_should_have_these_values_of_child_classes(): void
    {
        $this->assertSame('ChildClass one', TranslatedExample::EXAMPLE_1->name());
        $this->assertSame('ChildClass two', TranslatedExample::EXAMPLE_2->name());
        $this->assertSame('ChildClass three', TranslatedExample::EXAMPLE_3->name());
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
}
