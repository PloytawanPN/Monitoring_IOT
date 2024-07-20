<div>
    <div wire:loading.delay wire:target='delete' id="loadingOverlay" class="loading-overlay">
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
                        <div class="row mb-2">
                            <div class="col-lg-8">
                                <form class="form-inline">
                                    <div class="form-group mb-2">
                                        <label for="inputPassword2" class="sr-only">Search</label>
                                        <input type="search" class="form-control" id="inputPassword2"
                                            wire:model.live='search' placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <div class="text-lg-right">
                                    <a href="/InsertDevice" class="btn btn-info mb-2 mr-2">
                                        <i class="bi bi-plus"></i> <span>Insert Device</span>
                                    </a>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <thead class="thead-light">
                                    <tr>

                                        <th>#</th>
                                        <th>Device Name</th>
                                        <th>Location</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                        <th style="width: 125px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($devices as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $item->name ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->location ?? '-' }}
                                            </td>
                                            <td>
                                                {{ $item->detail ?? '-' }}
                                            </td>
                                            <td  wire:poll.1s="updateData">
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
                                                @if ($sum_volt == 0)
                                                    <h5><span class="badge badge-danger-lighten"><i
                                                                class="mdi mdi-coin"></i>
                                                            Abnormal</span></h5>
                                                @elseif ($SomeZero)
                                                    <h5><span class="badge badge-success-lighten"><i
                                                                class="mdi mdi-coin"></i>
                                                            Normal</span></h5>
                                                @else<h5><span class="badge badge-warning-lighten"><i
                                                                class="mdi mdi-coin"></i>
                                                            Warning</span></h5>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $encodedId = base64_encode($item->id);
                                                @endphp
                                                <a href="/dashboard/device/view/{{ $encodedId }}" class="action-icon">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                                <a href="/dashboard/device/edit/{{ $encodedId }}"
                                                    class="action-icon"><i
                                                        class="mdi mdi-square-edit-outline"></i></a>

                                                <a href="javascript:void(0);" class="action-icon"
                                                    onclick="insertDevice({{ $index }})"> <i
                                                        class="mdi mdi-delete"></i></a>

                                                <button wire:click='delete({{ $item->id }})' class="d-none"
                                                    id='bt_delete_{{ $index }}'>Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                    @if ($devices->isEmpty())
                        <h3 class="text-center" style="color: #d3d3d3; margin-top: 20px;margin-bottom: 40px">Not Found
                            Data</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('success:message', event => {
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "Your action was successful!",
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
        function insertDevice($index) {
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
                    const button = document.getElementById(`bt_delete_${$index}`);
                    button.click();
                }
            });
        }
    </script>
</div>
