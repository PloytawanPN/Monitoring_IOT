<div>

    <div wire:loading.delay wire:target="submit" id="loadingOverlay" class="loading-overlay">
        <div class="container_load">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>


    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header pt-4 pb-4 text-center bg-primary">
                            <a href="index.html">
                                <span><img src="{{ asset('assets/images/logo.png') }}" alt=""
                                        height="18"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center mt-0 font-weight-bold">Sign Up</h4>
                                <p class="text-muted mb-4">Don't have an account? Create your account, it takes less
                                    than a minute </p>
                            </div>

                            <form action="#">

                                <div class="form-group">
                                    <label for="fullname">Full Name</label>
                                    <input class="form-control" type="text" id="fullname"
                                        placeholder="Enter your name" wire:model="fullname" required>
                                </div>




                                <div class="form-group">
                                    <label for="branch">ฺBranch</label>
                                    <select class="form-control" id="example-select" id="branch" required
                                        wire:model="branch">
                                        <option value='' selected>Please select branch</option>
                                        @foreach ($branch_list as $item)
                                            <option value='{{$item->id}}'>{{$item->branch_name}}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="emailaddress">Email Address</label>
                                    <input class="form-control" type="text" id="emailaddress" required
                                        wire:model="email" placeholder="Enter your email">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            placeholder="Enter your password" wire:model="password">
                                        <div class="input-group-append" data-password="false">
                                            <div class="input-group-text">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div style="margin-top: 40px;" class="form-group mb-0 text-center">
                                    <button class="btn btn-primary" type="button" wire:click="submit"> Sign Up
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-muted">Already have account? <a href="/signin"
                                    class="text-muted ml-1"><b>Log In</b></a></p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('Error:Alert', event => {
            console.log(event);
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: event.detail[0].message,
            });
        });

        window.addEventListener('Success:Alert', event => {
            console.log(event);
            Swal.fire({
                icon: "success",
                title: "Succeed",
                text: 'Registration successful, please confirm your email.',
                allowOutsideClick: false,
                preConfirm: () => {
                    window.location.href = '/signin';
                }
            });
        });
    </script>
</div>
