<div>
    <div class="hader_setting">
        <label class="main_h">Settings</label>
        <label class="content">Manage your system setting and preferences</label>
        <hr>
    </div>
    <div class="mqtt">
        <label class="main_h">MQTT Connection</label>
        <lable class="content">Edit your mqtt broker connection information</lable>
        <table>
            <tr>
                <td>MQTT Server</td>
                <td><input placeholder="e.g. 192.168.10.20" type="text" wire:model.lazy='server'></td>
            </tr>
            <tr>
                <td>Port</td>
                <td><input placeholder="e.g. 1883" type="text" wire:model.lazy='port'></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><input placeholder="e.g. mqttuser1" type="text" wire:model.lazy='username'></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input placeholder="e.g. 123456" type="password" wire:model.lazy='password'></td>
            </tr>
        </table>
        <button wire:click='CheckConnection'>Test Connection</button>
        <button wire:click='SaveConfig'>Save Setting</button>
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
