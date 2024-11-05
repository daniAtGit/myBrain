<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Appunti
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
                        <a href="{{route('appunti.create')}}">
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
                            <th class="bg-light">Argomento</th>
                            <th class="bg-light">Titolo</th>
                            <th class="bg-light text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($appunti as $i => $appunto)
                            <tr>
                                <td style="border-bottom:1px solid {{$appunto->argomento?->color}};">
                                    <span style="display:none;">{{$appunto->created_at}}</span>
                                    {{$appunto->created_at->format('d/m/Y')}}
                                </td>
                                <td style="border-bottom:1px solid {{$appunto->argomento?->color}};">
                                    <span class="badge p-2" style="background:{{$appunto->argomento?->color}};{{$appunto->argomento?->color=='#000000'?'color:#fff':''}}">{{$appunto->argomento?->argument}}</span>
                                </td>
                                <td style="border-bottom:1px solid {{$appunto->argomento?->color}};">{{$appunto->title}}</td>
                                <td style="border-bottom:1px solid {{$appunto->argomento?->color}};">
                                    <a href="{{route('appunti.edit',$appunto)}}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delLezione{{$i}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
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
        @foreach($appunti as $i => $appunto)
            <div class="modal fade" id="delLezione{{$i}}" tabindex="-1" aria-labelledby="delLezione{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella appunto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('appunti.destroy',$appunto)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare questo appunto?
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
                            "targets": [0,1,3],
                            "width": "70px",
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
