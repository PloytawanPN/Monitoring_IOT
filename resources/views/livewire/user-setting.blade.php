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

                        <h4 class="header-title">Setting : Users</h4>


                        <div class="tab-content" style="margin-top: 20px">
                            <div class="tab-pane show active" id="small-table-preview">
                                <div class="table-responsive-sm">
                                    <table class="table table-sm table-centered mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Full Name</th>
                                                <th>E-Mail</th>
                                                <th>Status</th>
                                                <th>Register at</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users_list as $key => $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>
                                                        @if ($item->status == 2)
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="confirmReject({{ $item->id }})">
                                                                <i class="mdi mdi-window-close"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-success"
                                                                onclick="confirmApprove({{ $item->id }})">
                                                                <i class="mdi mdi-check"></i>
                                                            </button>

                                                            <button id="reject_{{ $item->id }}" class="d-none"
                                                                wire:click="reject({{ $item->id }})"></button>
                                                            <button id="approve_{{ $item->id }}" class="d-none"
                                                                wire:click="approve({{ $item->id }})"></button>
                                                        @else
                                                            {{ config('cache.user_status.' . $item->status . '.name') }}
                                                        @endif
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $encodedId = base64_encode($item->id);
                                                        @endphp
                                                        <a href="/setting/users/edit/{{$encodedId}}" type="button" class="btn btn-light"><i
                                                                class="mdi mdi-pencil"></i></a>
                                                        <button type="button" class="btn btn-light"
                                                            onclick="remove({{ $item->id }})"><i
                                                                class="mdi mdi-delete-outline"></i></button>
                                                        <button id="remove_{{ $item->id }}" class="d-none"
                                                            wire:click="remove({{ $item->id }})"></button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @if ($users_list->isEmpty())
                                        <h3 class="text-center" style="color: #d3d3d3; margin-top: 20px">Not Found Data</h3>
                                    @endif
                                </div> <!-- end table-responsive-->
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>
    @if(Session::has('alert:error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'User information not found!',
                allowOutsideClick: false,
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
            });
        </script>
    @endif
    <script>
        function remove(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to remove this account?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = document.getElementById(`remove_${itemId}`);
                    button.click();
                }
            });
        }

        function confirmApprove(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to approve this account?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = document.getElementById(`approve_${itemId}`);
                    button.click();
                }
            });
        }

        function confirmReject(itemId) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to reject this account?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const button = document.getElementById(`reject_${itemId}`);
                    button.click();
                }
            });
        }
        window.addEventListener('remove_success', event => {
            Swal.fire({
                title: "Success!",
                text: "This account has already been remove.",
                icon: "success"
            });
        });
        window.addEventListener('reject_success', event => {
            Swal.fire({
                title: "Rejected!",
                text: "This account has already been rejected.",
                icon: "success"
            });
        });
        window.addEventListener('approve_success', event => {
            Swal.fire({
                title: "Success!",
                text: "This account has already been approve.",
                icon: "success"
            });
        });
        window.addEventListener('error_alert', event => {
            Swal.fire({
                title: "Oop..!",
                text: "Something went wrong!",
                icon: "error"
            });
        });
    </script>
</div>
