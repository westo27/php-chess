<?php

namespace Chess;

/**
 * Class Player
 *
 * Represents a player in the chess game. A player can either be white or black.
 *
 * @package Chess
 */
class Player
{
    /**
     * @var string The name of the player, either 'white' or 'black'.
     */
    private string $name;

    /**
     * Player constructor.
     *
     * Initializes the player with a specified name (either 'white' or 'black').
     *
     * @param string $name The name of the player (either 'white' or 'black').
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the name of the player.
     *
     * @return string The name of the player ('white' or 'black').
     */
    public function getName(): string
    {
        return $this->name;
    }
}