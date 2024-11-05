<?php

namespace App\Http\Controllers\Favorites;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Link;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FavoritesController extends Controller
{
    public function index(): View
    {
        $favorites=Favorite::all()->sortByDesc('created_at')->load('links');
        return view('pages.favorites.index', compact('favorites'));
    }

    public function store(Request $request): RedirectResponse
    {
        $filename = now()->format('Y_m_d_H_i')."-".request('file')->getClientOriginalName();
        request()->file('file')->move(storage_path() . '/app/public/' , $filename);

        //leggo file
        $file = Storage::disk('public')->get($filename);
        $links = json_decode($file, true);
        $favorite = Favorite::create(['description' => $request->input('description')]);

        foreach($links as $i => $link){
            Link::create([
                'favorite_id' => $favorite->id,
                'index'       => $link['index'],
                'title'       => $link['title'] ?? null,
                'url'         => $link['url'] ?? null,
                'selfId'      => $link['id'],
                'parentId'    => $link['parentId']
            ]);
        }

        return redirect()->route('favorites.index')->with([
            'message' => 'Barra dei favoriti '.$favorite->description.' importata correttamente',
            'classe'   => 'alert-success'
        ]);
    }

    public function show(Favorite $favorite): View
    {
        $favorite->load('links','links.underlinks','links.underLinks.underLinks','links.underLinks.underLinks.underLinks','links.underLinks.underLinks.underLinks.underLinks');
        return view('pages.favorites.show', compact('favorite'));
    }

    public function edit(Favorite $favorite): View
    {
        $favorite->load('links','links.underlinks','links.underLinks.underLinks','links.underLinks.underLinks.underLinks','links.underLinks.underLinks.underLinks.underLinks');
        return view('pages.favorites.edit', compact('favorite'));
    }

    public function update(Request $request,Favorite $favorite): View
    {
        if($request->input('dir')) {
            $dir = Link::find($request->input('dir'))->load('underLinks');
            $favorite->links()->create([
                'index'     => $dir->underLinks->count() == 0 ? 0 : $dir->underLinks->max('index')+1,
                'title'     => $request->input('title'),
                'url'       => $request->input('url'),
                'selfId'    => Link::max('selfId')+1,
                'parentId'  => $dir->selfId,
            ]);
        }else{
            $favorite->links()->create([
                'index'     => Link::max('index')+1,
                'title'     => $request->input('title'),
                'url'       => $request->input('url'),
                'selfId'    => Link::max('selfId')+1,
                'parentId'  => 1
            ]);
        }
        return view('pages.favorites.edit', compact('favorite'));
    }

    public function destroy(Favorite $favorite): RedirectResponse
    {
        $nome=$favorite->description;
        $favorite->delete();
        return redirect()->route('favorites.index')->with([
            'message' => 'Barra dei favoriti '.$nome.' eliminata correttamente',
            'classe'   => 'alert-danger'
        ]);
    }

    public function exportJson(Favorite $favorite): BinaryFileResponse
    {
        $data = [];

        foreach($favorite->links as $link){
            $data[] = [
                "index" => $link->index,
                "title" => $link->title,
                "id" => $link->selfId,
                "parentId" => $link->parentID
            ];
        };

        $fileName = $favorite->description.'_bookmarks.json';
        $fileStorePath = storage_path() . '/app/public/' . $fileName;
        File::put($fileStorePath, json_encode($data));
        return response()->download($fileStorePath);
    }

    public function makeBookmarks(Favorite $favorite)
    {
        $collegamenti='';

        //apertura
        $data = '<!DOCTYPE NETSCAPE-Bookmark-file-1>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<TITLE>' . $favorite->description . '</TITLE>
<H1>' . $favorite->description . '</H1>
<DL><p>';
//    <DT><H3 ADD_DATE="' . time() . '" LAST_MODIFIED="' . time() . '" PERSONAL_TOOLBAR_FOLDER="true">Barra dei preferiti</H3>';

        foreach($favorite->links->where('parentId', 1) as $link){

            if (is_null($link->url)) {
                $collegamenti .= '
<DL><p>
<DT><H3 ADD_DATE="' . time() . '" LAST_MODIFIED="' . time() . '">'.$link->title.'</H3>
<DL><p>';

                $collegamenti = $this->exportUnderLink($favorite,$link,$collegamenti);

                $collegamenti .='
</DL><p>
<DL><p>';
            }else{
                $collegamenti.='
<DT><A HREF="'.$link->url.'" ADD_DATE="'.time().'">'.$link->title.'</A>';
            }
        }



        //chiusura
        $data.=$collegamenti.'
</DL><p>';

//dd($collegamenti,$data);

        $fileName = $favorite->description.'_bookmarks.html';
        $fileStorePath = storage_path() . '/app/public/' . $fileName;
        File::put($fileStorePath, $data);
        return response()->download($fileStorePath);
    }

    public function exportUnderLink($favorite,$link,$collegamenti)
    {
        $underlinks=Link::where('favorite_id',$favorite->id)->where('parentId',$link->selfId)->get();

        foreach($underlinks as $underlink){
            if (is_null($underlink->url)) {
                $collegamenti .= '
<DL><p>
<DT><H3 ADD_DATE="' . time() . '" LAST_MODIFIED="' . time() . '">'.$underlink->title.'</H3>
<DL><p>';

                $collegamenti =$this->exportUnderLink($favorite,$underlink,$collegamenti);

                $collegamenti .='
</DL><p>
<DL><p>';
            }else{
                $collegamenti .= '
<DT><A HREF="'.$underlink->url.'" ADD_DATE="'.time().'">'.$underlink->title.'</A>';
            }
        }
//dd($collegamenti);
        return $collegamenti;
    }

    public function modificaDescrizione(Request $request)
    {
        $favorite = Favorite::find($request->favorite_id);

        $favorite->update([
            'description' => $request->descrizione,
        ]);

        return view('pages.favorites.edit', compact('favorite'));
    }

    public function updateLink(Request $request, Favorite $favorite, Link $link)
    {
        $link->update([
            'title' => $request->title,
            'url'   => $request->url,
        ]);
        return view('pages.favorites.edit', compact('favorite'));
    }

    public function deleteLink(Favorite $favorite, Link $link)
    {
        foreach($link->underLinks as $underLink){
            $underLink->delete();
        }
        $link->delete();
        return view('pages.favorites.edit', compact('favorite'));
    }
}
