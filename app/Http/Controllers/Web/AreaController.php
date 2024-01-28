<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Area;

use Illuminate\Support\Facades\Http;

class AreaController extends Controller
{

    // public function index()
    // {
    //     $areas = Area::all();
    //     return view('areas.index', compact('areas'));
    // }

    // public function create()
    // {
    //     return view('areas.create');
    // }


    // public function store(Request $request)
    // {

    //     $request->validate([
    //         'name_area' => 'required',
    //         'address_area' => 'required'
    //     ]);


    //     Area::create($request->all());

    //     return redirect()->route('areas.index');
    // }

    // public function edit(Area $area)
    // {
    //     return view('areas.edit', compact('area'));
    // }

    // public function update(Request $request, Area $area)
    // {
    //     $request->validate([
    //         'name_area' => 'required',
    //         'address_area' => 'required'
    //     ]);

    //     $area->update($request->all());

    //     return redirect()->route('areas.index');
    // }



    // public function destroy(Area $area)
    // {
    //     $area->delete();
    //     return redirect()->route('areas.index');
    // }
}
