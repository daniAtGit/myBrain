<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica manutenzione
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="card">
            <div class="row my-4">
                <div class="col-1"></div>

                <div class="col-10">
                    <form method="post" action="{{route('manutenzioni.update', $manutenzione)}}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="oggetto" class="form-label">Oggetto</label>
                            <select required name="oggetto" class="form-control">
                                <option value=""></option>
                                @foreach($oggetti as $oggetto)
                                    <option value="{{$oggetto->id}}" @selected($oggetto->id == $manutenzione->oggetto_id)>{{$oggetto->brand->nome}} - {{$oggetto->descrizione}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fornitore" class="form-label">Fornitore</label>
                            <select required name="fornitore" class="form-control">
                                <option value=""></option>
                                @foreach($fornitori as $fornitore)
                                    <option value="{{$fornitore->id}}" @selected($fornitore->id == $manutenzione->fornitore_id)>{{$fornitore->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="data" class="form-label">Data</label>
                            <input required type="date" class="form-control border-gray-300" name="data" id="data" value="{{$manutenzione->data->format('Y-m-d')}}">
                        </div>

                        <div class="mb-3">
                            <label for="prezzo" class="form-label">Prezzo</label>
                            <input type="text" class="form-control border-gray-300" name="prezzo" id="prezzo" value="{{$manutenzione->prezzo}}">
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea name="note" id="note" class="form-control border-gray-300" rows="4">{{$manutenzione->note}}</textarea>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{route('manutenzioni.index')}}" class="btn btn-sm btn-outline-secondary">Indietro</a>
                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa-regular fa-floppy-disk"></i> Registra</button>
                        </div>
                    </form>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>
</x-app-layout>
