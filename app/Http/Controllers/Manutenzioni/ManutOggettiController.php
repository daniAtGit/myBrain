<?php

namespace App\Http\Controllers\Manutenzioni;

use App\Http\Controllers\Controller;
use App\Models\ManutBrand;
use App\Models\ManutCategoria;
use App\Models\ManutOggetto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManutOggettiController extends Controller
{
    public function index(): View
    {
        $manutOggetti = ManutOggetto::all()->sortBy('descrizione')->load('categoria','brand','manutenzioni');
        $categorie = ManutCategoria::all()->sortBy('nome');
        $brands = ManutBrand::all()->sortBy('nome');
        return view('pages.manutenzioni.oggetti.index', compact('manutOggetti', 'categorie', 'brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        ManutOggetto::create([
            'categoria_id' => $request->input('categoria'),
            'brand_id' => $request->input('brand'),
            'descrizione' => $request->input('descrizione'),
        ]);

        return redirect()->route('manutOggetti.index');
    }

    public function update(Request $request, ManutOggetto $manutOggetto): RedirectResponse
    {
        $manutOggetto->update([
            'categoria_id' => $request->input('categoria'),
            'brand_id' => $request->input('brand'),
            'descrizione' => $request->input('descrizione'),
        ]);

        return redirect()->route('manutOggetti.index');
    }

    public function destroy(ManutOggetto $manutOggetto): RedirectResponse
    {
        $manutOggetto->delete();
        return redirect()->route('manutOggetti.index');
    }
}
