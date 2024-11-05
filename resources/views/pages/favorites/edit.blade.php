<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-8">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    <form method="post" action="{{route('favorite.descrizione.modifica')}}">
                        @csrf
                        <input type="hidden" name="favorite_id" value="{{$favorite->id}}">

                        <div class="input-group mb-3">
                            <input required type="text" name="descrizione" class="form-control" style="border:1px dotted #ccc;border-right:none;" value="{{$favorite->description}}">
                            <div class="input-group-append border pt-2">
                                <button class="btn btn-sm fa fa-floppy-disk" type="submit" title="Modifica"></button>
                            </div>
                        </div>
                    </form>
                </h2>
            </div>
            <div class="col-4 text-right">
                <a href="{{route('favorites.index')}}" class="btn btn-sm btn-light">
                    < Indietro
                </a>

                <a href="{{route('favorites.show', $favorite)}}" class="btn btn-sm btn-light">
                    <i class="fa fa-eye text-info" title="Show!!"></i>
                </a>

                <i class="btn btn-sm btn-outline-primary fa fa-plus" title="Aggiungi" data-bs-toggle="modal" data-bs-target="#modalAdd"></i>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <table class="table table-striped table-bordered table-hover table-sm" id="datatableLink">
                <thead class="">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Index</th>
                        <th>Title</th>
                        <th>url</th>
                        <th>selfId</th>
                        <th>parentId</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorite->links as $i => $link)
{{--                        <livewire:riga-edit-link :link="$link" :wire:key="'edit-'.$link->id"/>--}}
                        <tr class="small">
                            <td>{{$i}}</td>
                            <td class="inline-flex">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalModifica{{$i}}">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalElimina{{$i}}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                            <td>{{$link->index}}</td>
                            <td>{{$link->title}}</td>
                            <td>{{$link->url}}</td>
                            <td>{{$link->selfId}}</td>
                            <td>{{$link->parentId}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @section('modal')
        @foreach($favorite->links as $i => $link)
            <!-- Modal Edit -->
            <div class="modal fade" id="modalModifica{{$i}}" tabindex="-1" aria-labelledby="modalModifica{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modifica favorito</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{route('favorites.link.update',[$favorite,$link])}}">
                            @csrf

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$link->title}}">
                                </div>

                                <div class="mb-3">
                                    <label for="url" class="form-label">url</label>
                                    <input type="text" class="form-control" id="url" name="url" value="{{$link->url}}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-trash"></i> Modifica</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Delete -->
            <div class="modal fade" id="modalElimina{{$i}}" tabindex="-1" aria-labelledby="modalElimina{{$i}}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Cancella favoriti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="get" action="{{route('favorites.link.delete',[$favorite,$link])}}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                Vuoi davvero eliminare il link {{$link->title}} {{$link->url}}?
                                @if($link->underLinks->count() > 0)
                                    <div class="alert alert-danger">
                                        Attenzione! Questo link ha {{$link->underLinks->count()}} sottolink. Procedendo eliminerò anche i sottolink
                                    </div>
                                @endif
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
                $('#datatableLink').dataTable({
                    "responsive": true,
                    "bSort":true,
                    "pageLength": 25,
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
                            "targets": [0,1,4,5],
                            "orderable": false
                        },
                        // {
                        //     "orderable": true,
                        //     "targets": 3,
                        //     "width": "200px"
                        // },
                        // {
                        //     "targets": [1,4,5],
                        //     "width": "50px"
                        // }
                    ],
                    //"order": [[ 1, "asc" ]]
                });
            });

            // window.addEventListener('linkDeleted', event => {
            //     location.reload();
            // });
        </script>
    @endsection
</x-app-layout>
