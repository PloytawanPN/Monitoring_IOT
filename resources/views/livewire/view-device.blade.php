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
                        <div class="tab-content">
                            <div class="tab-pane show active" id="datepicker-preview">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Device Name</label>
                                            <input placeholder="e.g. Device_1" wire:model.lazy="name" readonly
                                                class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group mb-3">
                                            <label>Device Location</label>
                                            <input placeholder="e.g. Tokyo Tower" class="form-control" readonly
                                                wire:model.lazy="location">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Device Detail</label>
                                            <input type="text" class="form-control" readonly
                                                placeholder="e.g. Device version1" wire:model.lazy="detail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div>
                                <button class="circular-button black_bt" style="margin-bottom: 10px" id="btClick_1">
                                    <i class='bx bxs-up-arrow'></i>
                                </button>
                                <button class="circular-button black_bt" id="btClick_2">
                                    <i class='bx bxs-down-arrow'></i>
                                </button>
                            </div>

                            <div class="button-container">
                                <div class="button-row">
                                    <button class="circular-button text red_bt" id="btClick_3">STOP</button>
                                    <button class="circular-button  text white_bt " id="btClick_4"
                                        style="outline: solid 2px rgb(218, 218, 218) !important;">AUTO</button>
                                </div>
                                <button class="circular-button  text" id="btClick_5">SETUP</button>
                                <div class="connecting-line" style="left: 23px;"></div>
                                <div class="connecting-line" style="right: 23px;"></div>
                                <div class="connecting-line-setup" style="right: 25px;"></div>
                                <div class="connecting-line-setup" style="left: 25px;"></div>
                            </div>

                            <div>
                                <button class="circular-button  text green_bt" id="btClick_6">START</button>
                            </div>

                            <div class="d-none">
                                @for ($i = 1; $i <= 6; $i++)
                                    <button wire:click="ToggleSwitch({{ $i }})" id="bt_{{ $i }}">
                                        Switch {{ $i }}
                                    </button>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="overflow: auto">
                        <table cellspacing="10" wire:poll.1s="updateData">
                            <tr>
                                <td></td>
                                <td
                                    class="green_status {{ $data['PEA']['Volt1'] == 0 || $data['PEA']['Volt2'] == 0 || $data['PEA']['Volt3'] == 0 ? 'red' : '' }}">
                                    PEA</td>
                                <td
                                    class="white_status {{ $data['GEN']['Volt1'] != 0 && $data['GEN']['Volt2'] != 0 && $data['GEN']['Volt3'] != 0 ? 'green' : '' }}">
                                    GEN</td>
                                <td
                                    class="green_status {{ $data['ATS']['Volt1'] == 0 || $data['ATS']['Volt2'] == 0 || $data['ATS']['Volt3'] == 0 ? 'red' : '' }}">
                                    ATS</td>
                                <td
                                    class="green_status {{ $data['UPS']['Volt1'] == 0 || $data['UPS']['Volt2'] == 0 || $data['UPS']['Volt3'] == 0 ? 'red' : '' }}">
                                    UPS</td>
                            </tr>
                            <tr>
                                <td class="blue_header">A-B</td>
                                <td class="green_status {{ $data['PEA']['Volt1'] == 0 ? 'red' : '' }}">
                                    {{ $data['PEA']['Volt1'] }} V</td>
                                <td class="white_status {{ $data['GEN']['Volt1'] != 0 ? 'green' : '' }}">
                                    {{ $data['GEN']['Volt1'] }} V</td>
                                <td class="green_status {{ $data['ATS']['Volt1'] == 0 ? 'red' : '' }}">
                                    {{ $data['ATS']['Volt1'] }} V</td>
                                <td class="green_status {{ $data['UPS']['Volt1'] == 0 ? 'red' : '' }}">
                                    {{ $data['UPS']['Volt1'] }} V</td>
                            </tr>
                            <tr>
                                <td class="blue_header">B-C</td>
                                <td class="green_status {{ $data['PEA']['Volt2'] == 0 ? 'red' : '' }}">
                                    {{ $data['PEA']['Volt2'] }} V</td>
                                <td class="white_status {{ $data['GEN']['Volt2'] != 0 ? 'green' : '' }}">
                                    {{ $data['GEN']['Volt2'] }} V</td>
                                <td class="green_status {{ $data['ATS']['Volt2'] == 0 ? 'red' : '' }}">
                                    {{ $data['ATS']['Volt2'] }} V</td>
                                <td class="green_status {{ $data['UPS']['Volt2'] == 0 ? 'red' : '' }}">
                                    {{ $data['UPS']['Volt2'] }} V</td>
                            </tr>
                            <tr>
                                <td class="blue_header">C-A</td>
                                <td class="green_status {{ $data['PEA']['Volt3'] == 0 ? 'red' : '' }}">
                                    {{ $data['PEA']['Volt3'] }} V</td>
                                <td class="white_status {{ $data['GEN']['Volt3'] != 0 ? 'green' : '' }}">
                                    {{ $data['GEN']['Volt3'] }} V</td>
                                <td class="green_status {{ $data['ATS']['Volt3'] == 0 ? 'red' : '' }}">
                                    {{ $data['ATS']['Volt3'] }} V</td>
                                <td class="green_status {{ $data['UPS']['Volt3'] == 0 ? 'red' : '' }}">
                                    {{ $data['UPS']['Volt3'] }} V</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('error:message', event => {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Something went wrong!",
            });
        });
        window.addEventListener('sucess:message', event => {
            Swal.fire({
                title: '',
                text: 'This action was successfully sent.',
                showConfirmButton: false,
                position: 'top-right',
                timer: 2000,
                backdrop: false,
                customClass: {
                    popup: 'swal-popup-green',
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 1; i <= 12; i++) {
                let button = document.getElementById(`btClick_${i}`);
                let targetButton = document.getElementById(`bt_${i}`);
                let timer;

                if (button && targetButton) {
                    button.addEventListener('mousedown', function() {
                        targetButton.click();
                    });

                    button.addEventListener('mouseup', function() {
                        targetButton.click();
                    });

                    button.addEventListener('mouseleave', function() {
                        clearTimeout(timer);
                    });
                }
            }
        });
    </script>
</div>
