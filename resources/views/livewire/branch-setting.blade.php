<div>
    <div wire:loading.delay wire:target="reject,approve,remove" id="loadingOverlay" class="loading-overlay">
        <div class="container_load">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>


    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="header-title">Setting : Branch</h4>
                            <button type="button" class="btn btn-info" wire:click="add_row">
                                <i class="mdi mdi-plus"></i>
                            </button>
                        </div>


                        <div class="tab-content" style="margin-top: 20px">
                            <div class="tab-pane show active" id="small-table-preview">
                                <div class="table-responsive-sm">
                                    <table class="table table-sm table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Branch Name</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($branch_list as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{$item->branch_name}}</td>
                                                    <td class="text-center">{{$item->account_count}}</td>
                                                    <td class="text-center">
                                                        <input type="checkbox" id="switch_{{ $key }}" data-switch="bool"
                                                            {{$item->status == 1 ? 'checked' : ''}}
                                                            wire:change="updateStatus({{ $item->id }}, $event.target.checked ? 1 : 2)" />
                                                        <label for="switch_{{ $key }}" data-on-label="On"
                                                            data-off-label="Off">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">-</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($branch_row as $k => $item)
                                                <tr>
                                                    <td class="text-center">#</td>
                                                    <td><input class="form-control" wire:model="branch_row.{{ $k }}.name">
                                                    </td>
                                                    <td class="text-center">-</td>
                                                    <td class="text-center">
                                                        <input type="checkbox" id="switch_{{ $k + $key + 1 }}"
                                                            data-switch="bool"
                                                            {{ $item['status'] ? 'checked' : '' }}  
                                                            wire:change="updateStatus_row({{ $k }}, $event.target.checked ? 1 : 2)"
                                                            />
                                                        <label for="switch_{{ $k + $key + 1 }}" data-on-label="On"
                                                            data-off-label="Off">
                                                        </label>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-light"
                                                            wire:click="removeRow({{ $k }})"><i
                                                                class="mdi mdi-delete-outline"></i></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @if ($branch_row)
                            <div class="row" style="margin-top: 20px">
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-outline-danger" style="margin-right: 20px"
                                        wire:click='cancel'>Cancel</button>
                                    <button type="button" class="btn btn-outline-success" wire:click='Savebranch'>Save
                                        Data</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success:message', event => {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your action was successful!',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        });
        window.addEventListener('error:notfound', event => {
            Swal.fire({
                icon: 'error',
                title: 'Oops..!',
                text: 'Your information is blank, please fill it in to save.',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        });
        window.addEventListener('error:message', event => {
            Swal.fire({
                icon: 'error',
                title: 'Oops..!',
                text: 'Something went wrong, please check.',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        });
        window.addEventListener('error:already', event => {
            const message = event.detail[0].message;
            console.log(message);
            Swal.fire({
                icon: 'error',
                title: 'Oops..!',
                text: message,
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
            });
        });
    </script>
</div>