<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Categorie
        </h2>
    </x-slot>

    <div class="container-fluid border">
        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-8">

                    </div>
                    <div class="col-4 text-end">
                        <form method="post" action="{{route('manutCategorie.store')}}">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="nome" placeholder="Nuovo" required>
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-floppy-disk"></i> Registra</button>
                            </div>
                        </form>
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
                            <th class="bg-light">Nome</th>
                            <th class="bg-light">Oggetti</th>
                            <th class="bg-light text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($manutCategorie as $i => $manutCategoria)
                                <tr>
                                    <td>{{$manutCategoria->nome}}</td>
                                    <td>{{$manutCategoria->oggetti->count()}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit{{$i}}">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        @if(!$manutCategoria->oggetti->count())
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del{{$i}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-light">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @endif
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
        @foreach($manutCategorie as $i => $manutCategoria)
            <div class="modal fade" id="edit{{$i}}" tabindex="-1" aria-labelledby="edit{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica categoria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('manutCategorie.update',$manutCategoria)}}" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="modal-body">
                                <input type="text" class="form-control" name="nome" placeholder="Nuovo" required value="{{$manutCategoria->nome}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-floppy-disk"></i> Registra</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="del{{$i}}" tabindex="-1" aria-labelledby="del{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella brand</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('manutCategorie.destroy',$manutCategoria)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <div class="modal-body">
                                Vuoi davvero eliminare questa categoria?
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
                            "targets": -1,
                            "width": "70px",
                            "className": 'dt-center',
                            "orderable": false
                        },
                        {
                            "targets": 1,
                            "width": "70px",
                            "className": 'dt-center'
                        }
                    ],
                    "order": [[0, 'asc']]
                });
            });
        </script>
    @stop

</x-app-layout>
