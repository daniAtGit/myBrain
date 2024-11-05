<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Oggetti
        </h2>
    </x-slot>

    <div class="container-fluid border">
        <div class="card mt-4">
            <div class="card-body">
{{--                    <h5 class="card-title">Card title</h5>--}}
{{--                    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>--}}
                <div class="row">
                    <div class="col-5">

                    </div>
                    <div class="col-7 text-end">
                        <form method="post" action="{{route('manutOggetti.store')}}">
                            @csrf
                            <div class="input-group mb-3">
                                <select required name="brand">
                                    <option value="">Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->nome}}</option>
                                    @endforeach
                                </select>
                                <select required name="categoria">
                                    <option value="">Categoria</option>
                                    @foreach($categorie as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->nome}}</option>
                                    @endforeach
                                </select>
                                <input required type="text" name="descrizione" class="form-control" placeholder="Nuovo">
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
                                <th class="bg-light">Descrizione</th>
                                <th class="bg-light">Categoria</th>
                                <th class="bg-light">Brand</th>
                                <th class="bg-light">Manut.</th>
                                <th class="bg-light text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($manutOggetti as $i => $manutOggetto)
                                <tr>
                                    <td>{{$manutOggetto->descrizione}}</td>
                                    <td>{{$manutOggetto->categoria->nome}}</td>
                                    <td>{{$manutOggetto->brand->nome}}</td>
                                    <td>{{$manutOggetto->manutenzioni->count()}}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit{{$i}}">
                                            <i class="fa-solid fa-edit"></i>
                                        </button>
                                        @if(!$manutOggetto->manutenzioni->count())
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del{{$i}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-light">
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
        @foreach($manutOggetti as $i => $manutOggetto)
            <div class="modal fade" id="edit{{$i}}" tabindex="-1" aria-labelledby="edit{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica oggetto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('manutOggetti.update',$manutOggetto)}}" method="post">
                            @csrf
                            @method('PATCH')

                            <div class="modal-body">
                                <div>
                                    <label for="brand" class="small">Brand</label>
                                    <br>
                                    <select required name="brand">
                                        <option value="">Brand</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand->id}}" @selected($brand->id == $manutOggetto->brand_id)>{{$brand->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="my-3">
                                    <label for="categoria" class="small">Categoria</label>
                                    <br>
                                    <select required name="categoria">
                                        <option value="">Categoria</option>
                                        @foreach($categorie as $categoria)
                                            <option value="{{$categoria->id}}" @selected($categoria->id == $manutOggetto->categoria_id)>{{$categoria->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="brand" class="small">Descrizione</label>
                                    <br>
                                    <input required type="text" name="descrizione" class="form-control" placeholder="descrizione" value="{{$manutOggetto->descrizione}}">
                                </div>
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella oggetto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('manutOggetti.destroy',$manutOggetto)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <div class="modal-body">
                                Vuoi davvero eliminare questo oggetto?
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
                            "targets": -2,
                            "width": "50px",
                            "className": 'dt-center'
                        }
                    ],
                    "order": [[0, 'asc']]
                });
            });
        </script>
    @stop

</x-app-layout>
