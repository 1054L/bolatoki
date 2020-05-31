<?php

namespace App\Http\Controllers;

use App\Player;
use App\Http\Requests\SavePlayerRequest;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::orderBy('name')->paginate(10);
        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new player.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('players.create', ['player' => new Player]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePlayerRequest $request)
    {
        Player::create($request->validated());
        return redirect()->route('players.index')->with('created', __('Player created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view('players.edit', array('player' => $player));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Player $player, SavePlayerRequest $request)
    {
        $player->update($request->validated());
        return redirect()->route('players.show', $player);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return redirect()->route('players.index');
    }
}
