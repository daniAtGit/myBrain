<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Manutenzioni
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
                        <a href="{{route('manutenzioni.create')}}">
                            <button type="button" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-circle-plus"></i> Nuova
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
                            <th class="bg-light">Oggetto</th>
                            <th class="bg-light">Fornitore</th>
                            <th class="bg-light">Prezzo</th>
                            <th class="bg-light">Note</th>
                            <th class="bg-light text-center"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($manutenzioni as $i => $manutenzione)
                                <tr>
                                    <td>
                                        <span style="display:none;">{{$manutenzione->data}}</span>
                                        {{$manutenzione->data->format('d/m/Y')}}
                                    </td>
                                    <td>{{$manutenzione->oggetto->descrizione}}</td>
                                    <td>{{$manutenzione->fornitore->nome}}</td>
                                    <td>€ {{$manutenzione->prezzo}}</td>
                                    <td class="small">{!! $manutenzione->note !!}</td>
                                    <td>
                                        <a href="{{route('manutenzioni.edit', $manutenzione)}}" class="btn btn-sm btn-outline-primary">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del{{$i}}">
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
        @foreach($manutenzioni as $i => $manutenzione)
            <div class="modal fade" id="del{{$i}}" tabindex="-1" aria-labelledby="del{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella fornitore</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('manutenzioni.destroy',$manutenzione)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <div class="modal-body">
                                Vuoi davvero eliminare questa manutenzione?
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
                            "targets": 0,
                            "width": "90px",
                        },
                        {
                            "targets": 3,
                            "width": "150px",
                        }
                    ],
                    "order": [[0, 'asc']]
                });
            });
        </script>
    @stop

</x-app-layout>
