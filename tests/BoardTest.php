<?php

use PHPUnit\Framework\TestCase;
use Chess\Board;
use Chess\Position;
use Chess\Player;
use Chess\Pieces\Bishop;
use Chess\Pieces\Knight;

class BoardTest extends TestCase
{
    public function testDefaultBoardInitializesProperly()
    {
        $board = new Board();
        $this->assertInstanceOf(Board::class, $board);
    }

    public function testInvalidBoardSizeThrows()
    {
        $this->expectException(InvalidArgumentException::class);
        new Board(7); // Odd size not allowed
    }

    public function testExcessiveBoardSizeThrows()
    {
        $this->expectException(InvalidArgumentException::class);
        new Board(Board::MAX_BOARD_SIZE + 2);
    }

    public function testPlaceAndGetPiece()
    {
        $board = new Board();
        $player = new Player("white");
        $bishop = new Bishop($player);
        $pos = new Position(2, 0);
        $board->placePiece($bishop, $pos);

        $this->assertSame($bishop, $board->getPieceAtPosition($pos));
    }

    public function testMovePiece()
    {
        $board = new Board();
        $player = new Player("white");
        $bishop = new Bishop($player);
        $from = new Position(2, 0);
        $to = new Position(4, 2);
        $board->placePiece($bishop, $from);

        $board->movePiece($from, $to, $player);

        $this->assertNull($board->getPieceAtPosition($from));
        $this->assertSame($bishop, $board->getPieceAtPosition($to));
    }

    public function testMoveOpponentPieceThrows()
    {
        $board = new Board();
        $white = new Player("white");
        $black = new Player("black");
        $bishop = new Bishop($white);
        $from = new Position(2, 0);
        $to = new Position(4, 2);
        $board->placePiece($bishop, $from);

        $this->expectException(Exception::class);
        $board->movePiece($from, $to, $black);
    }

    public function testCannotCaptureOwnPiece()
    {
        $board = new Board();
        $player = new Player("white");
        $from = new Position(2, 0);
        $to = new Position(4, 2);

        $bishop1 = new Bishop($player);
        $bishop2 = new Bishop($player);

        $board->placePiece($bishop1, $from);
        $board->placePiece($bishop2, $to);

        $this->expectException(Exception::class);
        $board->movePiece($from, $to, $player);
    }

    public function testIsPathClearTrue()
    {
        $board = new Board();
        $from = new Position(2, 0);
        $to = new Position(4, 2);

        $this->assertTrue($board->isPathClear($from, $to));
    }

    public function testIsPathClearFalseDueToBlock()
    {
        $board = new Board();
        $player = new Player("white");

        $from = new Position(2, 0);
        $mid = new Position(3, 1);
        $to = new Position(4, 2);

        $board->placePiece(new Bishop($player), $mid);

        $this->assertFalse($board->isPathClear($from, $to));
    }

    public function testIsPathClearFalseOnNonDiagonal()
    {
        $board = new Board();
        $from = new Position(0, 0);
        $to = new Position(0, 5);
        $this->assertFalse($board->isPathClear($from, $to));
    }
}