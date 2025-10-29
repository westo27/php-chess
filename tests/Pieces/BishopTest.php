<?php

namespace Pieces;

use PHPUnit\Framework\TestCase;
use Chess\Board;
use Chess\Player;
use Chess\Position;
use Chess\Pieces\Bishop;

class BishopTest extends TestCase
{
    public function testBishopCanMoveDiagonally()
    {
        $board = new Board();
        $player = new Player("white");
        $bishop = new Bishop($player);
        $from = new Position(2, 0);
        $to = new Position(4, 2);
        $board->placePiece($bishop, $from);

        $this->assertTrue($bishop->canMove($board, $from, $to));
    }

    public function testBishopBlockedByAnotherPiece()
    {
        $board = new Board();
        $player = new Player("white");
        $bishop = new Bishop($player);
        $blocker = new Bishop($player);
        $from = new Position(2, 0);
        $mid = new Position(3, 1);
        $to = new Position(4, 2);

        $board->placePiece($bishop, $from);
        $board->placePiece($blocker, $mid);

        $this->assertFalse($bishop->canMove($board, $from, $to));
    }

    public function testBishopCannotMoveNonDiagonally()
    {
        $board = new Board();
        $player = new Player("white");
        $bishop = new Bishop($player);
        $from = new Position(2, 0);
        $to = new Position(2, 3);

        $this->assertFalse($bishop->canMove($board, $from, $to));
    }

    public function testGetSymbol()
    {
        $playerWhite = new Player("white");
        $bishopWhite = new Bishop($playerWhite);
        $this->assertEquals("♗", $bishopWhite->getSymbol());

        $playerBlack = new Player("black");
        $bishopBlack = new Bishop($playerBlack);
        $this->assertEquals("♝", $bishopBlack->getSymbol());
    }
}