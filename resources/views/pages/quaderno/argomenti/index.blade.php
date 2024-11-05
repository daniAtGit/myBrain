<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Argomenti
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
                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addArgomento">
                            <i class="fa-solid fa-circle-plus"></i> Nuovo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card my-4">
            <div class="row my-4">
                <div class="col-1"></div>

                <div class="col-10">
                    <table class="table table-hover table-bordered border" id="tabella">
                        <thead>
                        <tr>
                            <th class="bg-light">Argomento</th>
                            <th class="bg-light">Colore</th>
                            <th class="bg-light">Appunti</th>
                            <th class="bg-light text-center">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($argomenti as $i => $argomento)
                            <tr>
                                <td style="border-bottom:1px solid {{$argomento->color}};">{{$argomento->argument}}</td>
                                <td style="border-bottom:1px solid {{$argomento->color}};">
                                    <span class="badge p-2" style="background:{{$argomento->color}};{{$argomento->color=='#000000'?'color:#fff':''}}">{{$argomento->color}}</span>
                                </td>
                                <td style="border-bottom:1px solid {{$argomento->color}};">{{$argomento->appunti->count()}}</td>
                                <td style="border-bottom:1px solid {{$argomento->color}};">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modArgomento{{$i}}">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>

                                    @if($argomento->appunti->count())
                                        <button type="button" class="btn btn-sm btn-light" title="Non si può eliminare">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delArgomento{{$i}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endif
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
        <!-- Modal -->
        <div class="modal fade" id="addArgomento" tabindex="-1" aria-labelledby="addArgomento" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuovo argomento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('argomenti.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="argument" class="form-label">Argomento</label>
                                <input type="text" class="form-control" id="argument" name="argument" required>
                            </div>
                            <div class="mb-3">
                                <label for="color" class="form-label">Colore</label>
                                <input type="color" class="form-control" id="color" name="color" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-floppy-disk"></i> Salva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach($argomenti as $i => $argomento)
            <div class="modal fade" id="modArgomento{{$i}}" tabindex="-1" aria-labelledby="modArgomento{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica argomento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('argomenti.update',$argomento)}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="argument" class="form-label">Argomento</label>
                                    <input type="text" class="form-control" id="argument" name="argument" value="{{$argomento->argument}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="color" class="form-label">Colore</label>
                                    <input type="color" class="form-control" id="color" name="color" value="{{$argomento->color}}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-floppy-disk"></i> Salva</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="delArgomento{{$i}}" tabindex="-1" aria-labelledby="delArgomento{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella argomento</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('argomenti.destroy',$argomento)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare questo argomento?
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
                            "targets": [1,2,3],
                            "width": "70px",
                            "className": 'dt-center'
                        },
                        { "orderable": false, "targets": 3 }
                    ],
                    "order": [[0, 'asc']]
                });
            });
        </script>
    @stop

</x-app-layout>
