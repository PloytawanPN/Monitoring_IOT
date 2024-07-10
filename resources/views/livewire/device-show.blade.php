<div>
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
            <td class="green_status {{ $data['PEA']['Volt1'] == 0 ? 'red' : '' }}">{{ $data['PEA']['Volt1'] }}</td>
            <td class="white_status {{ $data['GEN']['Volt1'] != 0 ? 'green' : '' }}">{{ $data['GEN']['Volt1'] }}</td>
            <td class="green_status {{ $data['ATS']['Volt1'] == 0 ? 'red' : '' }}">{{ $data['ATS']['Volt1'] }}</td>
            <td class="green_status {{ $data['UPS']['Volt1'] == 0 ? 'red' : '' }}">{{ $data['UPS']['Volt1'] }}</td>
        </tr>
        <tr>
            <td class="blue_header">B-C</td>
            <td class="green_status {{ $data['PEA']['Volt2'] == 0 ? 'red' : '' }}">{{ $data['PEA']['Volt2'] }}</td>
            <td class="white_status {{ $data['GEN']['Volt2'] != 0 ? 'green' : '' }}">{{ $data['GEN']['Volt2'] }}</td>
            <td class="green_status {{ $data['ATS']['Volt2'] == 0 ? 'red' : '' }}">{{ $data['ATS']['Volt2'] }}</td>
            <td class="green_status {{ $data['UPS']['Volt2'] == 0 ? 'red' : '' }}">{{ $data['UPS']['Volt2'] }}</td>
        </tr>
        <tr>
            <td class="blue_header">C-A</td>
            <td class="green_status {{ $data['PEA']['Volt3'] == 0 ? 'red' : '' }}">{{ $data['PEA']['Volt3'] }}</td>
            <td class="white_status {{ $data['GEN']['Volt3'] != 0 ? 'green' : '' }}">{{ $data['GEN']['Volt3'] }}</td>
            <td class="green_status {{ $data['ATS']['Volt3'] == 0 ? 'red' : '' }}">{{ $data['ATS']['Volt3'] }}</td>
            <td class="green_status {{ $data['UPS']['Volt3'] == 0 ? 'red' : '' }}">{{ $data['UPS']['Volt3'] }}</td>
        </tr>
    </table>
    <div>
        @for ($i = 1; $i <= 12; $i++)
            <button class="button-82-pushable bt_class" role="button" id="btClick_{{ $i }}">
                <span class="button-82-shadow"></span>
                <span class="button-82-edge"></span>
                <span class="button-82-front text">
                    Switch {{ $i }}
                </span>
              </button>
        @endfor
    </div>

    <div style="display: none">
        @for ($i = 1; $i <= 12; $i++)
            <button wire:click="ToggleSwitch({{ $i }})" id="bt_{{ $i }}">
                Switch {{ $i }}
            </button>
        @endfor
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            for (let i = 1; i <= 12; i++) {
                let button = document.getElementById(`btClick_${i}`);
                let targetButton = document.getElementById(`bt_${i}`);
                let timer;

                if (button && targetButton) {
                    button.addEventListener('mousedown', function() {
                        // Trigger click on the corresponding target button
                        targetButton.click();
                    });

                    button.addEventListener('mouseup', function() {
                        // Trigger click on the corresponding target button
                        targetButton.click();
                    });

                    button.addEventListener('mouseleave', function() {
                        // Clear any timers associated with this button
                        clearTimeout(timer);
                    });
                }
            }
        });
    </script>
</div>
