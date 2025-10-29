<?php

/**
 * Class Position
 *
 * Represents a position on the chessboard with x and y coordinates.
 * Ensures the position is within the valid board limits (0-7).
 *
 * @package Chess
 */

namespace Chess;

class Position
{
    /**
     * The x-coordinate (column) of the position on the chessboard (0-7).
     *
     * @var int
     */
    public int $x;

    /**
     * The y-coordinate (row) of the position on the chessboard (0-7).
     *
     * @var int
     */
    public int $y;

    /**
     * Position constructor.
     *
     * @param int $x The x-coordinate (column) of the position (0-7).
     * @param int $y The y-coordinate (row) of the position (0-7).
     * @throws \InvalidArgumentException If the position is out of bounds (less than 0 or greater than 7).
     */
    public function __construct(int $x, int $y)
    {
        if ($x < 0 || $x > 7 || $y < 0 || $y > 7) {
            throw new \InvalidArgumentException("Invalid position.");
        }
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Get the x-coordinate (column) of the position.
     *
     * @return int The x-coordinate (column) of the position (0-7).
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Get the y-coordinate (row) of the position.
     *
     * @return int The y-coordinate (row) of the position (0-7).
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * Checks if this position is diagonal to another position.
     *
     * A position is diagonal if the absolute difference between the x-coordinates is equal to
     * the absolute difference between the y-coordinates.
     *
     * @param Position $other The other position to compare with.
     * @return bool True if the positions are diagonal to each other, false otherwise.
     */
    public function isDiagonalTo(Position $other): bool
    {
        return abs($this->x - $other->getX()) === abs($this->y - $other->getY());
    }

    /**
     * Calculates the direction from this position to another position.
     *
     * The direction is represented as an array with the differences in x and y coordinates.
     *
     * @param Position $other The other position to calculate the direction to.
     * @return array The direction as an array with keys 'dx' and 'dy'.
     */
    public function directionTo(Position $other): array
    {
        return [
            'dx' => $other->getX() - $this->x,
            'dy' => $other->getY() - $this->y,
        ];
    }
}