<div style="margin-top: 7px;height: 100%;">
    <div class="container" wire:loading>
        <div class="bg_loading">
            <div class="space">
                <div class="loader"></div>
                <label>Loading...</label>
            </div>
        </div>
    </div>
    <div style="height: 100%;" class="screen_area">
        <div class="insert_field">
            <div>
                <div class="bt_position">
                    <a href="{{ route('dashboard') }}" class="back_bt"><i class='bx bx-exit icon'></i>Back</a>
                </div>

                <div class="header">
                    <span>Insert Device</span>
                </div>
                <div class="content">
                    <div class="input_field">
                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <label>Device Name</label>
                        <input placeholder="e.g. Device_1" wire:model.lazy="name">
                    </div>
                    <div class="input_field">
                        @error('location')
                            <span class="error">{{ $message }}</span>
                        @enderror
                        <label>Device Location </label>
                        <input placeholder="e.g. Tokyo Tower" wire:model.lazy="location">
                    </div>
                    <div class="input_field">
                        <label>Device Detail</label>
                        <textarea placeholder="e.g. Device version1" wire:model.lazy="detail"></textarea>
                    </div>
                </div>
            </div>
            <div>
                <button class="add_bt" wire:click="add_device">Add Device</button>
                <button class="save_bt" wire:click="save_device">Save Device</button>
            </div>
        </div>
        <div class="list_field">
            @foreach ($device_list as $index => $item)
                <div class="card_device">
                    <div class="device_row">
                        <label class="fixed_width">Device Name</label>:
                        <label>{{ isset($item['name']) ? $item['name'] : '-' }}</label>
                    </div>
                    <div class="device_row">
                        <label class="fixed_width">Device Location</label>:
                        <label>{{ isset($item['location']) ? $item['location'] : '-' }}</label>
                    </div>
                    <div class="device_row">
                        <label class="fixed_width">Device Detail</label>:
                        <label>{{ isset($item['detail']) ? $item['detail'] : '-' }}</label>
                    </div>
                    <div class="bt_trash">
                        <i class='bx bx-trash icon' wire:click="deleteDevice({{ $index }})"></i>
                    </div>
                </div>
            @endforeach
            @if (count($device_list) == 0)
                <div class="not_found">
                    <h1>Not Found Data</h1>
                </div>
            @endif
        </div>
    </div>
    <div>
        <button wire:click='confirm_delete' id='bt_delete' style="display: none">confirm</button>

        <script>
            window.addEventListener('swal:alert', event => {
                Swal.fire({
                    title: event.detail[0].message,
                    text: event.detail[0].text,
                    icon: event.detail[0].type,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    confirmButtonColor: '#4BC6FF',
                    customClass: {
                        confirmButton: 'swal-button-width'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        /* window.location.href = "/"; */
                    }
                });
            });
        </script>

        <script>
            window.addEventListener('DeleteAlert', event => {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('bt_delete').click();
                        window.addEventListener('ConfirmDelete', event => {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your device has been deleted.",
                                icon: "success"
                            });
                        });
                    }
                });
            });
        </script>
    </div>
</div>