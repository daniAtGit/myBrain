<?php

namespace App\Http\Controllers\Quaderno;

use App\Http\Controllers\Controller;
use App\Models\Appunto;
use App\Models\Argomento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppuntiController extends Controller
{
    public function index(): View
    {
        $appunti=Appunto::all()->load('argomento');
        return view('pages.quaderno.appunti.index', compact('appunti'));
    }

    public function create(): View
    {
        $argomenti=Argomento::orderBy('argument','asc')->get();
        return view('pages.quaderno.appunti.create', compact('argomenti'));
    }

    public function store(Request $request): RedirectResponse
    {
        Argomento::find($request->argomento)->appunti()->create([
            'argument_id'=>$request->argomento,
            'title'=>$request->titolo,
            'lesson'=>$request->lezione,
        ]);
        return redirect()->route('appunti.index');
    }

    public function edit(Appunto $appunto): View
    {
        $argomenti=Argomento::orderBy('argument','asc')->get();
        return view('pages.quaderno.appunti.edit', compact('appunto','argomenti'));
    }

    public function update(Request $request, Appunto $appunto): RedirectResponse
    {
        $appunto->update([
            'argument_id'=>$request->argomento,
            'title'=>$request->titolo,
            'lesson'=>$request->lezione,
        ]);
        return redirect()->route('appunti.index');
    }

    public function destroy(Appunto $appunto): RedirectResponse
    {
        $appunto->delete();
        return redirect()->route('appunti.index');
    }
}
