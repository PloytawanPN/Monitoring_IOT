<div>
    <!-- <div class="container" wire:loading wire:target="redirect_insert,view">
        <div class="bg_loading">
            <div class="space">
                <div class="loader"></div>
            </div>
        </div>
    </div> -->
    <div class="search_field">
        <i class='bx bx-search icon_s'></i>
        <input type="text" placeholder="Search..." wire:model.lazy="search">
        <button wire:click="redirect_insert"><span>Insert Device</span><i class='bx bx-plus icon'></i></button>
    </div>
    {{-- <button wire:click='sendMessage'>LED ON</button> --}}
    <div wire:poll.1s="updateData">
        @foreach ($devices as $item)
                @php
                    $sum_volt = 0;
                    $SomeZero = true;
                    foreach ($data[$item->name] as $key => $de) {
                        if ($key === 'GEN') {
                            continue;
                        }
                        foreach ($de as $value) {
                            $sum_volt += $value;
                            if ($value == 0) {
                                $SomeZero = false;
                            }
                        }
                    }
                @endphp
                <div class="card_row">
                    <div class="detail">
                        <label class="status">
                            <div class="{{$sum_volt == 0 ? 'red_status' : ($SomeZero ? 'green_status' : 'yellow_status')}}">
                            </div>
                        </label>
                        <label class="name">Name : {{$item->name}}</label>

                        <label class="location">Location : {{$item->location}}</label>
                    </div>
                    <div>
                        <button class="view_bt" wire:click="view({{$item->id}})">view</button>
                    </div>
                </div>
        @endforeach
        @if (count($devices) == 0)
            <div class="not_found">
                <h1>Not Found Data</h1>
            </div>
        @endif
    </div>
</div>