<div class="nav-link">

    <div class="selezionato">
        <i class="fa fa-folder directory" role="button" id="{{$link->id}}"></i> {{$link->title}}
    </div>

    <div id="sub-{{$link->id}}" style="display:none;" class="submenu">
        @foreach($link->underLinks as $underlink)
            @if($underlink->favorite_id === $favorite->id)
                @if(is_null($underlink->url))
                    <livewire:directory-component :link="$underlink" :favorite="$favorite" :wire:key="'dir-'.$underlink->id" />
                @else
                    <livewire:link-component :link="$underlink" :wire:key="'link-'.$underlink->id" />
                @endif
            @endif
        @endforeach
    </div>

</div>
