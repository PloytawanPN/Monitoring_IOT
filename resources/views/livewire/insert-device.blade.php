<div style="margin-top: 7px;height: 100%;">
    <div wire:loading.delay id="loadingOverlay" wire:target='add_device,save_device,deleteDevice,confirm_delete,update'
        class="loading-overlay">
        <div class="container_load">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 20px">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if ($id != 0)
                            <h4 class="header-title">Edit Device</h4>
                            <p class="text-muted font-14">
                                Edit information to connect to your device.
                            </p>
                        @else
                            <h4 class="header-title">Insert Device</h4>
                            <p class="text-muted font-14">
                                Add information to connect to your device.
                            </p>
                        @endif

                        <div class="tab-content">
                            <div class="tab-pane show active" id="datepicker-preview">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Device Name</label>
                                            <input placeholder="e.g. Device_1" wire:model.lazy="name"
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Device Location</label>
                                            <input placeholder="e.g. Tokyo Tower" class="form-control"
                                                wire:model.lazy="location">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Device Detail</label>
                                            <input type="text" class="form-control"
                                                placeholder="e.g. Device version1" wire:model.lazy="detail">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px">
                                    <div class="col-12 text-center">
                                        @if ($id == 0)
                                            <button type="button" class="btn btn-outline-info"
                                                style="margin-right: 20px" wire:click="add_device">Add Device</button>
                                            <button type="button" class="btn btn-outline-success"
                                                wire:click="save_device">Save Device</button>
                                        @else
                                            <button  wire:click="update" type="button" class="btn btn-outline-success"
                                                >Save Data</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($id == 0)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead class="thead-light">
                                    <tr>

                                        <th>#</th>
                                        <th>Device Name</th>
                                        <th>Location</th>
                                        <th>Detail</th>
                                        <th style="width: 125px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($device_list as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ isset($item['name']) ? $item['name'] : '-' }}
                                            </td>
                                            <td>
                                                {{ isset($item['location']) ? $item['location'] : '-' }}
                                            </td>
                                            <td>
                                                {{ isset($item['detail']) ? $item['detail'] : '-' }}
                                            </td>
                                            <td>
                                                <i wire:click="deleteDevice({{ $index }})"
                                                    style="cursor: pointer" class="mdi mdi-delete"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                    @if (count($device_list) == 0)
                        <h3 class="text-center" style="color: #d3d3d3; margin-top: 20px;margin-bottom: 40px">Not Found
                            Data
                        </h3>
                    @endif
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    @endif

    <button wire:click='confirm_delete' id='bt_delete' style="display: none">confirm</button>



    <script>
        window.addEventListener('success:message', event => {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "Your action was successful!",
            });
        });
        window.addEventListener('Success:update', event => {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your action was successful!',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                willClose: () => {
                    window.location.href = '/dashboard';
                }
            });
        });
    </script>

    <script>
        window.addEventListener('error:message', event => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            });
        });
    </script>

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
                    window.location.href = "/dashboard";
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
