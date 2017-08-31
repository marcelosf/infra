<?php

namespace Infra\Http\Controllers\Infra;

use Infra\Model\Infra\Rack;
use Illuminate\Http\Request;


class RackController extends Controller
{

    protected $rack;

    public function __construct(Rack $rack)
    {

        $this->rack = $rack;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $racks = $this->rack->all();

        return view('rack.index', compact('racks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('rack.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->rack->create($request->all());

        return redirect()->route('rack.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Rack $rack
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Rack $rack)
    {

        $rack = $this->rack->find($rack);

        return view('rack.show', compact('rack'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rack $rack
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Rack $rack)
    {

        $rack = $this->rack->find($rack);

        return view('rack.edit', compact($rack));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rack $rack
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Rack $rack)
    {

        $this->rack->find($rack)->update($request->all());

        return redirect()->route('rack.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Rack $rack
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Rack $rack)
    {

        $this->rack->find($rack)->delete();

        return redirect()->route('rack.index');

    }
}
