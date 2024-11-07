<div class="nav-link">
    <div class="selezionato">
        <a href="{{$link->url}}" title="{{$link->url}}" target="_blank">
            <i class="fa fa-square-arrow-up-right"></i>
            {{strlen($link->title) > 12 ? Str::substr($link->title, 0, 12).'...' : $link->title}}
        </a>
    </div>
</div>
