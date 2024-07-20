<div>
    <div wire:loading.delay wire:target='CheckConnection,SaveConfig,confirm_to_save' id="loadingOverlay" class="loading-overlay">
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
                        <h4 class="header-title">Setting: MQTT</h4>
                        <p class="text-muted font-14">
                            Edit your MQTT broker connection information
                        </p>

                        <div class="tab-content">
                            <div class="tab-pane show active" id="datepicker-preview">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>MQTT Server</label>
                                            <input placeholder="e.g. 192.168.10.20" class="form-control" type="text"
                                                wire:model.lazy='server'>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Port</label>
                                            <input placeholder="e.g. 1883" class="form-control" type="text"
                                                wire:model.lazy='port'>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input placeholder="e.g. mqttuser1" class="form-control" type="text"
                                                wire:model.lazy='username'>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input placeholder="e.g. 123456" class="form-control" type="password"
                                                wire:model.lazy='password'>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 20px">
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-outline-info" style="margin-right: 20px"
                                            wire:click='CheckConnection'>Test Connection</button>
                                        <button type="button" class="btn btn-outline-success"
                                            wire:click='SaveConfig'>Save Setting</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <button id='bt_ConfirmSave' style="display: none" wire:click='confirm_to_save'></button>
    <script>
        window.addEventListener('Error:Alert', event => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "There is something wrong with your server connection!",
            });
        });

        window.addEventListener('Success:Alert', event => {
            Swal.fire({
                icon: "success",
                title: "Connected",
                text: "Can connect to server",
            });
        });

        window.addEventListener('SaveAlert', event => {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to save this data?',
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('bt_ConfirmSave').click();
                    window.addEventListener('ConfirmSave', event => {
                        Swal.fire({
                            title: "Saved!",
                            text: "The information has been updated.",
                            icon: "success"
                        });
                    });
                }
            });
        });
    </script>

</div>
