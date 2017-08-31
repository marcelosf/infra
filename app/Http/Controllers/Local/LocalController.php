<?php

namespace Infra\Http\Controllers\Local;

use Infra\Model\Local\Local;
use Illuminate\Http\Request;
use Infra\Http\Controllers\Controller;

class LocalController extends Controller
{

    protected $local;


    public function __construct(Local $local)
    {

        $this->local = $local;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $locals = $this->local->paginate(10);

        return view('local.index', compact('locals'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('local.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->local->create($request->all());

        return redirect()->route('local.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $local = $this->local->find($id);

        return view('local.show', compact('local'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $local = $this->local->find($id);

        return view('local.edit', compact('local'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->local->find($id)->update($request->all());

        return redirect()->route('local.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->local->find($id)->delete();

        return redirect()->route('local.index');

    }
}
