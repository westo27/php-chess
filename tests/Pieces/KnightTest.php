<?php

namespace Pieces;

use PHPUnit\Framework\TestCase;
use Chess\Board;
use Chess\Player;
use Chess\Position;
use Chess\Pieces\Knight;

class KnightTest extends TestCase
{
    public function testKnightCanMoveInLShape()
    {
        $board = new Board();
        $player = new Player("white");
        $knight = new Knight($player);
        $from = new Position(1, 0);
        $to = new Position(2, 2);
        $this->assertTrue($knight->canMove($board, $from, $to));
    }

    public function testKnightCanMoveInAllLShapes()
    {
        $board = new Board();
        $player = new Player("white");
        $knight = new Knight($player);
        $from = new Position(4, 4);

        $validMoves = [
            new Position(6, 5),
            new Position(6, 3),
            new Position(5, 6),
            new Position(5, 2),
            new Position(2, 5),
            new Position(2, 3),
            new Position(3, 6),
            new Position(3, 2),
        ];

        foreach ($validMoves as $to) {
            $this->assertTrue($knight->canMove($board, $from, $to));
        }
    }

    public function testKnightCannotMoveStraightOrDiagonal()
    {
        $board = new Board();
        $player = new Player("white");
        $knight = new Knight($player);
        $from = new Position(4, 4);
        $invalidMoves = [
            new Position(4, 5), // vertical
            new Position(5, 4), // horizontal
            new Position(5, 5), // diagonal
        ];

        foreach ($invalidMoves as $to) {
            $this->assertFalse($knight->canMove($board, $from, $to));
        }
    }

    public function testGetSymbol()
    {
        $playerWhite = new Player("white");
        $knightWhite = new Knight($playerWhite);
        $this->assertEquals("♘", $knightWhite->getSymbol());

        $playerBlack = new Player("black");
        $knightBlack = new Knight($playerBlack);
        $this->assertEquals("♞", $knightBlack->getSymbol());
    }
}