<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Nuovo appunto
        </h2>
    </x-slot>

    <div class="container mt-6">
        <div class="card">
            <div class="row my-4">
                <div class="col-1"></div>

                <div class="col-10">
                    <form method="post" action="{{route('appunti.store')}}">
                        @csrf

                        <div class="mb-3">
                            <label for="argomento" class="form-label">Argomento</label>
                            <select class="form-control select2" name="argomento" id="argomento" required>
                                <option value="">Seleziona...</option>
                                @foreach($argomenti as $argomento)
                                    <option value="{{ $argomento->id }}">{{ $argomento->argument }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="titolo" class="form-label">Titolo</label>
                            <input type="text" class="form-control" id="titolo" name="titolo" required>
                        </div>

                        <div class="mb-3">
                            <label for="lezione" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="lezione" name="lezione" rows="10" required></textarea>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="{{route('appunti.index')}}" class="btn btn-sm btn-outline-secondary">Annulla</a>
                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa-regular fa-floppy-disk"></i> Registra</button>
                        </div>
                    </form>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap select2 - style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <!-- Bootstrap select2 - script -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $( '#argomento' ).select2( {
            theme: 'bootstrap-5'
        } );
    </script>
</x-app-layout>
