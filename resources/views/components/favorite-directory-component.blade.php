<div class="nav-link">

    <div class="selezionato">
        <i class="fa fa-folder directory" role="button" id="{{$link->id}}"></i> {{$link->title}}
    </div>

    <div id="sub-{{$link->id}}" style="display:none;" class="submenu">
        @foreach($link->underLinks as $underlink)
            @if($underlink->favorite_id === $favorite->id)
                @if(is_null($underlink->url))
                    <x-favorite-directory-component :link="$underlink" :favorite="$favorite"></x-favorite-directory-component>
                @else
                    <x-favorite-link-component :link="$underlink"></x-favorite-link-component>
                @endif
            @endif
        @endforeach
    </div>

</div>
