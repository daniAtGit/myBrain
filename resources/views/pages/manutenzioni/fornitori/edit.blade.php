<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifica fornitore
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="card">
            <div class="row my-4">
                <div class="col-1"></div>

                <div class="col-10">
                    <form method="post" action="{{route('manutFornitori.update', $manutFornitore)}}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required value="{{$manutFornitore->nome}}">
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{$manutFornitore->telefono}}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$manutFornitore->email}}">
                        </div>

                        <div class="mb-3">
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" name="note" rows="4">{{$manutFornitore->note}}</textarea>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{route('manutFornitori.index')}}" class="btn btn-sm btn-outline-secondary">Indietro</a>
                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa-regular fa-floppy-disk"></i> Registra</button>
                        </div>
                    </form>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>
</x-app-layout>
