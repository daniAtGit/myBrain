<?php

namespace App\Http\Controllers\Manutenzioni;

use App\Http\Controllers\Controller;
use App\Models\Manutenzione;
use App\Models\ManutFornitore;
use App\Models\ManutOggetto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManutenzioniController extends Controller
{
    public function index(): View
    {
        $manutenzioni=Manutenzione::all()->load('oggetto', 'fornitore');
        return view('pages.manutenzioni.manutenzioni.index', compact('manutenzioni'));
    }

    public function create(): View
    {
        $oggetti=ManutOggetto::all()->sortBy('descrizione')->load('brand');
        $fornitori=ManutFornitore::all()->sortBy('nome');
        return view('pages.manutenzioni.manutenzioni.create', compact('oggetti','fornitori'));
    }

    public function store(Request $request): RedirectResponse
    {
        Manutenzione::create([
            'oggetto_id' => $request->input('oggetto'),
            'fornitore_id' => $request->input('fornitore'),
            'data' => $request->input('data'),
            'prezzo' => $request->input('prezzo'),
            'note' => $request->input('note')
        ]);
        return redirect()->route('manutenzioni.index');
    }

    public function edit(Manutenzione $manutenzione)
    {
        $oggetti=ManutOggetto::all()->sortBy('descrizione')->load('brand');
        $fornitori=ManutFornitore::all()->sortBy('nome');
        return view('pages.manutenzioni.manutenzioni.edit', compact('oggetti','fornitori','manutenzione'));
    }

    public function update(Request $request, Manutenzione $manutenzione): RedirectResponse
    {
        $manutenzione->update([
            'oggetto_id' => $request->input('oggetto'),
            'fornitore_id' => $request->input('fornitore'),
            'data' => $request->input('data'),
            'prezzo' => $request->input('prezzo'),
            'note' => $request->input('note')
        ]);
        return redirect()->route('manutenzioni.index');
    }

    public function destroy(Manutenzione $manutenzione): RedirectResponse
    {
        $manutenzione->delete();
        return redirect()->route('manutenzioni.index');
    }
}
