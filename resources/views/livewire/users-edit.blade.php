<div>
    <div class="container-fluid" style="margin-top: 20px;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Edit : Users</h4>
                        <p class="text-muted font-14">
                            Bootstrap-datepicker provides a flexible datepicker widget in the Bootstrap style.
                        </p>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="datepicker-preview">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Fullname</label>
                                            <input type="text" class="form-control" wire:model="name">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Email</label>
                                            <input type="text" class="form-control" disabled wire:model="email">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" type="text" class="form-control"
                                                wire:model="password">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select class="select2 form-control select2-multiple"
                                                data-placeholder="Choose ..." wire:model="branch_id">
                                                @foreach ($branch_list as $item)
                                                    <option value="{{$item->id}}">{{$item->branch_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="select2 form-control select2-multiple"
                                                data-placeholder="Choose ..." wire:model="status">
                                                @foreach (config('cache.user_status') as $item)
                                                    <option value="{{$item['status']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="select2 form-control select2-multiple"
                                                data-placeholder="Choose ..." wire:model="role">
                                                @foreach (config('cache.user_role') as $item)
                                                    <option value="{{$item['role']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px">
                                    <div class="col-12 text-center">
                                        <a href="/setting/users" class="btn btn-outline-danger"
                                            style="margin-right: 20px">Cancel</a>
                                        <button type="button" class="btn btn-outline-success" wire:click='SaveUser'>Save
                                            User</button>
                                    </div>
                                </div>
                            </div> <!-- end preview-->
                        </div> <!-- end tab-content-->
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
    </div>
    <script>
        window.addEventListener('Error:Alert', event => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something goes wrong!",
            });
        });

        window.addEventListener('Success:Alert', event => {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Your data has been successfully saved.",
            });
        });
    </script>
</div>