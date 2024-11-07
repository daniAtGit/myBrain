<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-4">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ $favorite->description }}
                </h2>
            </div>
            <div class="col-8 text-right">
                <a href="{{route('favorites.index')}}">
                    <button type="button" class="btn btn-sm bg-light">< Indietro</button>
                </a>
            </div>
        </div>
    </x-slot>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @foreach($favorite->links->where('parentId',1) as $link)
                        @if(is_null($link->url))
                            <x-favorite-directory-component :link="$link" :favorite="$favorite"></x-favorite-directory-component>
                        @else
                            <x-favorite-link-component :link="$link"></x-favorite-link-component>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    @section('style')
        <style>
            .evidenziato{
                padding-left: 2px;
                border-left: 1px solid #eee;
                border-bottom: 1px solid #eee;
            }
        </style>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                $('.directory').on('mouseenter', function(){
                    let sub = "sub-"+this.id
                    //alert(sub);
                    $('#'+sub).show();
                });

                $('.directory').on('click', function(){
                    let sub = "sub-"+this.id
                    $('#'+sub).hide();
                });

                $('.submenu').on('click', function(){
                   $('#'+this.id).hide();
                });

                $('.submenu').on('mouseenter', function(){
                    //console.log('enter '+this.id);
                });

                $('.submenu').on('mouseleave', function(){
                    $('#'+this.id).hide();
                });

                $(".selezionato").hover(function() {
                    $(this).addClass('evidenziato');
                });

                $(".selezionato").mouseleave(function() {
                    $(this).removeClass('evidenziato');
                });
            });
        </script>
    @endsection
</x-app-layout>
