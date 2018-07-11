<?php

/*
 * This file is part of StringBuilder.
 *
 * (c) Hiroto Kitazawa <hiro.yo.yo1610@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use HirotoK\StringBuilder\StringBuilder;
use HirotoK\StringBuilder\StringBuilderInterface;
use PHPUnit\Framework\TestCase;

class StringBuilderTest extends TestCase
{
    /**
     * @var string
     */
    protected $item;

    public function setUp()
    {
        $this->item = 'Test string.';
    }

    public function testConstruct()
    {
        $sb = new StringBuilder($this->item);
        $this->assertInstanceOf(StringBuilder::class, $sb);
        $this->assertInstanceOf(StringBuilderInterface::class, $sb);
    }

    public function testMake()
    {
        $sb = StringBuilder::make($this->item);
        $this->assertInstanceOf(StringBuilder::class, $sb);
        $this->assertInstanceOf(StringBuilderInterface::class, $sb);
    }

    public function testAppend()
    {
        $sb = new StringBuilder('test.');
        $newStr = $sb->append('append.')->toString();
        $this->assertEquals('test.append.', $newStr);
    }

    public function testPrepend()
    {
        $sb = new StringBuilder('test.');
        $newStr = $sb->prepend('prepend.')->toString();
        $this->assertEquals('prepend.test.', $newStr);
    }

    public function testUpcase()
    {
        $sb = new StringBuilder('tesT');
        $newStr = $sb->upcase()->toString();
        $this->assertEquals('TEST', $newStr);
    }

    public function testDowncase()
    {
        $sb = new StringBuilder('TeST');
        $newStr = $sb->downcase()->toString();
        $this->assertEquals('test', $newStr);
    }

    public function testStartsWith()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertTrue($sb->startsWith('ab'));
    }

    public function testStartsWithFalse()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertFalse($sb->startsWith('fg'));
    }

    public function testStartsWithByArray()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertTrue($sb->startsWith(['fg', 'ab']));
    }

    public function testStartsWithFalseArray()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertFalse($sb->startsWith(['fg', 'cd']));
    }

    public function testEndsWith()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertTrue($sb->endsWith('fg'));
    }

    public function testEndsWithFalse()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertFalse($sb->endsWith('ab'));
    }

    public function testEndsWithByArray()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertTrue($sb->endsWith(['ab', 'cd', 'fg']));
    }

    public function testEndsWithFalseByArray()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertFalse($sb->endsWith(['cd', 'ab', 'ef']));
    }

    public function testLength()
    {
        $sb = new StringBuilder('length');
        $this->assertEquals(6, $sb->length());
    }

    public function testSize()
    {
        $sb = new StringBuilder('size');
        $this->assertEquals(4, $sb->size());
        $this->assertEquals($sb->length(), $sb->size());
    }

    public function testPad()
    {
        $sb = new StringBuilder('pad');
        $newStr = $sb->pad(10, '-')->toString();
        $this->assertEquals('pad-------', $newStr);
    }

    public function testPadWithRight()
    {
        $sb = new StringBuilder('pad');
        $newStr = $sb->pad(10, '-', STR_PAD_RIGHT)->toString();
        $this->assertEquals('pad-------', $newStr);
    }

    public function testPadWithLeft()
    {
        $sb = new StringBuilder('pad');
        $newStr = $sb->pad(10, '-', STR_PAD_LEFT)->toString();
        $this->assertEquals('-------pad', $newStr);
    }

    public function testPadWithBoth()
    {
        $sb = new StringBuilder('pad');
        $newStr = $sb->pad(10, '-', STR_PAD_BOTH)->toString();
        $this->assertEquals('---pad----', $newStr);
    }

    public function testRightPad()
    {
        $sb = new StringBuilder('pad');
        $newStr = $sb->rightPad(10, '-')->toString();
        $this->assertEquals('pad-------', $newStr);
    }

    public function testLeftPad()
    {
        $sb = new StringBuilder('pad');
        $newStr = $sb->leftPad(10, '-')->toString();
        $this->assertEquals('-------pad', $newStr);
    }

    public function testReplace()
    {
        $sb = new StringBuilder('PHP,Ruby,Python');
        $newStr = $sb->replace(',', '/')->toString();
        $this->assertEquals('PHP/Ruby/Python', $newStr);
    }

    public function testIreplace()
    {
        $sb = new StringBuilder('PHP,Ruby,Python');
        $newStr = $sb->ireplace('p', 'p')->toString();
        $this->assertEquals('pHp,Ruby,python', $newStr);
    }

    public function testUcFirst()
    {
        $sb = new StringBuilder('abc');
        $newStr = $sb->ucFirst()->toString();
        $this->assertEquals('Abc', $newStr);
    }

    public function testLcFirst()
    {
        $sb = new StringBuilder('ABC');
        $newStr = $sb->lcFirst()->toString();
        $this->assertEquals('aBC', $newStr);
    }

    public function testTrim()
    {
        $sb = new StringBuilder("  \t\nTest\t\n  ");
        $newStr = $sb->trim()->toString();
        $this->assertEquals('Test', $newStr);
    }

    public function testRtrim()
    {
        $sb = new StringBuilder("  \t\nTest\t\n  ");
        $newStr = $sb->rtrim()->toString();
        $this->assertEquals("  \t\nTest", $newStr);
    }

    public function testLtrim()
    {
        $sb = new StringBuilder("   \t\nTest\t\n  ");
        $newStr = $sb->ltrim()->toString();
        $this->assertEquals("Test\t\n  ", $newStr);
    }

    public function testExplode()
    {
        $sb = new StringBuilder('PHP,Ruby,Python');
        $this->assertEquals(['PHP', 'Ruby', 'Python'], $sb->explode(','));
    }

    public function testIndexOf()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertEquals(2, $sb->indexOf('c'));
    }

    public function testIndexOfOnNotHas()
    {
        $sb = new StringBuilder('abcdefg');
        $this->assertNull($sb->indexOf('z'));
    }

    public function testLimit()
    {
        $sb = new StringBuilder('abcdefghijklmnopqrstuvwxyz');
        $newStr = $sb->limit(10)->toString();
        $this->assertEquals('abcdefghij...', $newStr);
    }

    public function testLimitWithEnd()
    {
        $sb = new StringBuilder('abcdefghijklmnopqrstuvwxyz');
        $newStr = $sb->limit(10, ',,,')->toString();
        $this->assertEquals('abcdefghij,,,', $newStr);
    }

    public function testLimitOnShort()
    {
        $sb = new StringBuilder('abc');
        $newStr = $sb->limit(10)->toString();
        $this->assertEquals('abc', $newStr);
    }

    public function testReverse()
    {
        $sb = new StringBuilder('abcd');
        $newStr = $sb->reverse()->toString();
        $this->assertEquals('dcba', $newStr);
    }

    public function testShuffle()
    {
        $sb = new StringBuilder('abc');
        $newStr = $sb->shuffle()->toString();
        $this->assertRegExp('/(a|b|c)/', $newStr);
    }

    public function testSplit()
    {
        $sb = new StringBuilder('test');
        $this->assertEquals(['t', 'e', 's', 't'], $sb->split());
    }

    public function testSplitWithLength()
    {
        $sb = new StringBuilder('test');
        $this->assertEquals(['te', 'st'], $sb->split(2));
    }

    public function testStripTags()
    {
        $sb = new StringBuilder('<p>test string</p>');
        $newStr = $sb->stripTags()->toString();
        $this->assertEquals('test string', $newStr);
    }

    public function testStripTagsWithAllowableTags()
    {
        $sb = new StringBuilder('<p>test p</p><span>test span</span>');
        $newStr = $sb->stripTags('<p>')->toString();
        $this->assertEquals('<p>test p</p>test span', $newStr);
    }

    public function testSubStr()
    {
        $sb = new StringBuilder('abcdefg');
        $newStr = $sb->subStr(4)->toString();
        $this->assertEquals('efg', $newStr);
    }

    public function testToFloat()
    {
        $sb = new StringBuilder('1');
        $this->assertEquals(1.0, $sb->toFloat());
    }

    public function testToInt()
    {
        $sb = new StringBuilder('1');
        $this->assertEquals(1, $sb->toInt());
    }

    public function testToString()
    {
        $sb = new StringBuilder($this->item);
        $this->assertEquals($this->item, $sb->toString());
    }

    public function test__toString()
    {
        $sb = new StringBuilder($this->item);
        $this->assertEquals($this->item, $sb->__toString());
        $this->assertEquals($sb->toString(), $sb->__toString());
    }
}