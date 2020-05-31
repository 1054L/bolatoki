<?php

namespace App\Services;

use App\Court;
use App\Match;
use App\MatchPlayer;
use App\Player;

class ClassificationService
{
    private $league;
    private $matches;
    private $players;

    public function __construct()
    {
    }

    public static function getClassification(array $matches, array $players)
    {
        



        $linea = array();
        foreach ($matches as $key => $match) {
            $matchPlayers = $match->players();
            $participants = array_diff($matchPlayers, $players);
            foreach ($participants as $player) {
                $linea[$key] = array('result_' . $key => $player->result);
                $order[] = array(
                    'name' => $player->name,
                    ''
                );
            }
        }
        return $this->classification;
    }
}
