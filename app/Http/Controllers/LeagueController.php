<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SaveLeagueRequest;
use App\Services\ClassificationService;
use App\League;
use App\MatchPlayer;

class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leagues = League::orderBy('start_date', 'desc')->paginate();
        return view('leagues.index', compact('leagues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leagues.create', ['league' => new League]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLeagueRequest $request)
    {
        League::create($request->validated());
        return redirect()->route('leagues.index')->with('created', __('League created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(League $league)
    {
        return view('leagues.show', compact('league'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        return view('leagues.edit', compact('league'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveLeagueRequest $request, League $league)
    {
        $league->update($request->validated());
        return redirect()->route('league.show', $league);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        $league->delete();
        return redirect()->route('league.index');
    }

    public function getLastLeague()
    {
        return League::last();
    }

    public function getActualClassification()
    {
        return $this->getClassification();
    }

    public function getClassification($date = null)
    {
        if (null == $date) {
            $date = date('Y-M-d');
        }
        $league = new league();
        // $classification = League::orderBy(
        //     MatchPlayer::select('result')
        //         ->whereColumn('match', $league->matches(), 'IN')
        //         ->orderBy('result')
        //     )->get();
        //     dd($classification);
        return view('index', compact('classification'));
    }
}
