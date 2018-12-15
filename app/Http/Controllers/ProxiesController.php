<?php

namespace App\Http\Controllers;

use App\Proxy;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProxiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proxies = Proxy::all();

        return view('proxies.index', compact('proxies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proxies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ip' => 'required|ipv4|unique:proxies',
            'port' => 'required|numeric|max:999999'
        ]);

        $proxy = new Proxy();
        $proxy->fill($request->all());
        $proxy->save();

        return redirect()->route('proxies.index')->with('success', 'New proxy has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proxy = Proxy::find($id);

        return view('proxies.edit', compact('proxy'));
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
        $proxy = Proxy::find($id);

        $this->validate($request, [
            'ip' => ['required', 'ipv4', Rule::unique('proxies')->ignore($proxy->id)],
            'port' => 'required|numeric|max:999999'
        ]);

        $proxy->fill($request->all());
        $proxy->is_not_work = $request->is_not_work ? 0 : 1;
        $proxy->save();

        return redirect()->route('proxies.index')->with('success', 'Proxy has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proxy::find($id)->delete();

        return redirect()->route('proxies.index')->with('success', 'Proxy has been deleted.');
    }

    /**
     * Remove all not working resources from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $proxies = Proxy::where('is_not_work', '=', 1)->get();

        foreach ($proxies as $proxy) {
            $proxy->delete();
        }

        return redirect()->route('proxies.index')->with('success', 'Proxies has been deleted.');
    }
}
