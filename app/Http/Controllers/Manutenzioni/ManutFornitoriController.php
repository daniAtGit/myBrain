<?php

namespace App\Http\Controllers\Manutenzioni;

use App\Http\Controllers\Controller;
use App\Models\ManutFornitore;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManutFornitoriController extends Controller
{
    public function index(): View
    {
        $manutFornitori=ManutFornitore::all()->load('manutenzioni');
        return view('pages.manutenzioni.fornitori.index', compact('manutFornitori'));
    }

    public function create(): View
    {
        return view('pages.manutenzioni.fornitori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        ManutFornitore::create([
            'nome' => $request->nome,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'note' => $request->note,
        ]);
        return redirect()->route('manutFornitori.index');
    }

    public function edit(ManutFornitore $manutFornitore): View
    {
        return view('pages.manutenzioni.fornitori.edit', compact('manutFornitore'));
    }

    public function update(Request $request, ManutFornitore $manutFornitore): RedirectResponse
    {
        $manutFornitore->update([
            'nome' => $request->nome,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'note' => $request->note,
        ]);
        return redirect()->route('manutFornitori.index');
    }

    public function destroy(ManutFornitore $manutFornitore): RedirectResponse
    {
        $manutFornitore->delete();
        return redirect()->route('manutFornitori.index');
    }
}
