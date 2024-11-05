<tr wire:key="tr-{{$link->id}}">
    <form wire:submit.prevent="modifica()">

        <td class="text-center">
            <button class="btn btn-sm fa fa-floppy-disk" type="button" wire:click="modifica()" title="Modifica"></button>
            <button class="btn btn-sm fa fa-trash text-danger" type="button" wire:click="cancella()" title="Elimina"></button>
        </td>
        <td class="text-center">{{$link->index}}</td>
        <td>
            <span style="display:none">{{$link->title}}</span>
            <input type="text" wire:model.defer="link.title" class="form-control">
        </td>
        <td>
            <span style="display:none">{{$link->url}}</span>
            <input type="text" wire:model.defer="link.url" class="form-control">
        </td>
        <td>{{$link->selfId}}</td>
        <td>{{$link->parentId}}</td>

    </form>
</tr>
