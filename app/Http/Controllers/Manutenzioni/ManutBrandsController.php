<?php

namespace App\Http\Controllers\Manutenzioni;

use App\Http\Controllers\Controller;
use App\Models\ManutBrand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ManutBrandsController extends Controller
{
    public function index(): View
    {
        $manutBrands=ManutBrand::all()->load('oggetti');
        return view('pages.manutenzioni.brands.index', compact('manutBrands'));
    }

    public function store(Request $request): RedirectResponse
    {
        ManutBrand::create([
            'nome' => $request->nome,
        ]);
        return redirect()->route('manutBrands.index');
    }

    public function update(Request $request, ManutBrand $manutBrand): RedirectResponse
    {
        $manutBrand->update([
            'nome' => $request->nome,
        ]);
        return redirect()->route('manutBrands.index');
    }

    public function destroy(ManutBrand $manutBrand): RedirectResponse
    {
        $manutBrand->delete();
        return redirect()->route('manutBrands.index');
    }
}
