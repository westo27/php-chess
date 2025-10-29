<?php

use PHPUnit\Framework\TestCase;
use Chess\Position;

class PositionTest extends TestCase
{
    public function testValidPositionConstruction()
    {
        $pos = new Position(3, 4);
        $this->assertInstanceOf(Position::class, $pos);
        $this->assertEquals(3, $pos->getX());
        $this->assertEquals(4, $pos->getY());
    }

    public function testInvalidPositionThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new Position(8, 4); // Invalid position, outside board range
    }

    public function testIsDiagonalToTrue()
    {
        $a = new Position(1, 1);
        $b = new Position(3, 3);
        $this->assertTrue($a->isDiagonalTo($b));
    }

    public function testIsDiagonalToFalse()
    {
        $a = new Position(1, 1);
        $b = new Position(1, 3);
        $this->assertFalse($a->isDiagonalTo($b));
    }

    public function testDirectionTo()
    {
        $a = new Position(1, 1);
        $b = new Position(4, 5);
        $this->assertEquals(['dx' => 3, 'dy' => 4], $a->directionTo($b));
    }
}