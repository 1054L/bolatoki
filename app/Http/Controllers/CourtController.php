<?php

namespace App\Http\Controllers;

use App\Court;
use App\Http\Requests\SaveCourtRequest;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courts = Court::orderBy('id')->paginate();
        return view('courts.index', compact('courts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courts.create', ['court' => new Court]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCourtRequest $request, Court $court)
    {
        $court->create($request->validated());
        return redirect()->route('courts.index')->with('created', __('Court created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Court $court)
    {
        return view('courts.show', compact('court'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Court $court)
    {
        return view('courts.edit', compact('court'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCourtRequest $request, Court $court)
    {
        $court->update($request->validated());
        return redirect()->route('courts.show', compact('court'))->with('updated', __('Court updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Court $court)
    {
        $court->delete();
        return view('courts.index')->with('deleted', __('Court deleted successfully'));
    }
}
