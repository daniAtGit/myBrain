<?php

namespace App\Http\Controllers\Quaderno;

use App\Http\Controllers\Controller;
use App\Models\Argomento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArgomentiController extends Controller
{
    public function index(): View
    {
        $argomenti=Argomento::all()->sortBy('argument');
        return view('pages.quaderno.argomenti.index', compact('argomenti'));
    }

    public function store(Request $request): RedirectResponse
    {
        Argomento::create([
            'argument'=>$request->input('argument'),
            'color'=>$request->input('color')
        ]);

        return redirect()->route('argomenti.index');
    }

    public function update(Request $request, Argomento $argomento): RedirectResponse
    {
        $argomento->update([
            'argument'  =>$request->input('argument'),
            'color'     =>$request->input('color')
        ]);

        return redirect()->route('argomenti.index');
    }

    public function destroy(Argomento $argomento): RedirectResponse
    {
        $argomento->delete();

        return redirect()->route('argomenti.index');
    }
}
