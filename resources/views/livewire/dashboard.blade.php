<div>
    <div class="search_field">
        <i class='bx bx-search icon_s'></i>
        <input type="text" placeholder="Search...">
        <button wire:click="redirect_insert"><span>Insert Device</span><i class='bx bx-plus icon'></i></button>
    </div>
    <div wire:poll.1s="updateData">
        @foreach ($devices as $item)
            <div class="card_row {{$data[$item->name]['ATS']['Volt1'] == 0 ? 'error_line':''}}" >
                <div class="detail">
                    <label class="name">Name : {{$item->name}}</label>
                    <label class="location">Location : {{$item->location}} </label>
                </div>
                <div>
                    <button class="view_bt" wire:click="view({{$item->id}})">view</button>
                </div>
            </div>
        @endforeach
    </div>
</div>