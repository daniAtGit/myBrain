<?php

namespace App\Http\Controllers\Manutenzioni;

use App\Http\Controllers\Controller;
use App\Models\ManutCategoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManutCategorieController extends Controller
{
    public function index(): View
    {
        $manutCategorie=ManutCategoria::all()->load('oggetti');
        return view('pages.manutenzioni.categorie.index', compact('manutCategorie'));
    }

    public function store(Request $request): RedirectResponse
    {
        ManutCategoria::create([
            'nome' => $request->nome,
        ]);
        return redirect()->route('manutCategorie.index');
    }

    public function update(Request $request, ManutCategoria $manutCategoria): RedirectResponse
    {
        $manutCategoria->update([
            'nome' => $request->nome,
        ]);
        return redirect()->route('manutCategorie.index');
    }

    public function destroy(Manutcategoria $manutCategoria): RedirectResponse
    {
        $manutCategoria->delete();
        return redirect()->route('manutCategorie.index');
    }
}
