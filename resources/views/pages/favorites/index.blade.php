<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Favoriti
        </h2>
    </x-slot>

    <div class="container-fluid border">
        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-6">

                    </div>
                    <div class="col-6 text-end">
                        <a role="button" data-bs-toggle="modal" data-bs-target="#modalNuova">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-circle-plus"></i> Nuovo
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card mb-4">
            <div class="row mt-3">
                <div class="col-1"></div>

                <div class="col-10">
                    <table class="table table-hover table-bordered border" id="tabella">
                        <thead>
                            <tr>
                                <th class="bg-light">Data</th>
                                <th class="bg-light">Descrizione</th>
                                <th class="bg-light">Links</th>
                                <th class="bg-light text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($favorites as $i => $favorite)
                                <tr>
                                    <td>{{$favorite->created_at->format('d/m/Y H:i')}}</td>
                                    <td>{{$favorite->description}}</td>
                                    <td class="text-center">{{$favorite->links->count()}}</td>
                                    <td class="text-center">
                                        <a href="{{route('favorites.show',$favorite)}}" class="btn btn-sm btn-outline-info">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{route('favorites.edit',$favorite)}}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalElimina{{$i}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <a href="{{route('favorite.makeBoomarks',$favorite)}}" class="btn btn-sm btn-outline-success">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-1"></div>
            </div>
        </div>
    </div>


    @section('modal')
        <!-- Modal New -->
        <div class="modal fade" id="modalNuova" tabindex="-1" aria-labelledby="modalNuova" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuova favoriti</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="{{route('favorites.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row p-2 m-2 border-b-2">
                            <div class="col-span-12 p-1">
                                <label for="description">Titolo</label>
                                <input required type="text" name="description" class="form-control">
                            </div>
                        </div>

                        <div class="row p-2 m-2">
                            <div class="col-span-12 small border">
                                Occorre procurarsi il file json dei link preferiti. Per fare ciò è possibile installare su Chrome l'estensione "Export History and Bookmarks to JSON / CSV* / XLS*"<br>
                                https://chrome.google.com/webstore/detail/export-historybookmarks-t/dcoegfodcnjofhjfbhegcgjgapeichlf<br>
                                Per gli altri browser al momento non esiste nulla.
                            </div>

                            <div class="col-span-12 mt-2">
                                <label for="file">File <span class="small">(json)</span></label>
                                <input required type="file" name="file" class="form-control" accept=".json">
                            </div>
                        </div>

                        <div class="row p-2 m-2">
                            <div class="col-span-12 text-end">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-floppy-disk"></i> Salva</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        @foreach($favorites as $i => $favorite)
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella favoriti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('favorites.destroy',$favorite)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare la barra dei favoriti "{{$favorite->description}}", e tutti i suoi {{$favorite->links->count()}} links?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> Elimina</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @stop

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#tabella').dataTable({
                    "responsive": true,
                    "bSort":true,
                    "pageLength": 10,
                    "paging": true,
                    "bPaginate":true,
                    "pagingType":"full_numbers",
                    "language": {
                        "lengthMenu": "Mostra _MENU_ record",
                        "zeroRecords": "Nessun risultato",
                        "info": "Pagina _PAGE_ di _PAGES_",
                        "infoEmpty": "Nessun risultato disponibile",
                        "infoFiltered": "(filtro di  _MAX_ record totali)",
                        "search": "",
                        "searchPlaceholder": "Cerca...",
                        "paginate": {
                            first:      '<<',
                            previous:   '‹',
                            next:       '›',
                            last:       '>>'
                        },
                    },
                    "columnDefs": [
                        {
                            "targets": 0,
                            "width": "130px",
                            "className": 'dt-center'
                        },
                        {
                            "targets": 2,
                            "width": "60px",
                            "className": 'dt-center'
                        },
                        {
                            "targets": 3,
                            "width": "140px",
                            "className": 'dt-center'
                        },
                        { "orderable": false, "targets": 3 }
                    ],
                    "order": [[0, 'desc']]
                });
            });
        </script>
    @stop
</x-app-layout>
