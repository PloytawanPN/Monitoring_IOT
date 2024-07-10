<div>
    @php
        $currentPath = request()->path();
    @endphp

    <div class="navbar_card">
        <div class="circle_bt">
            <div style="position: relative;">
                <i class='bx bx-chevron-left icon'></i>
            </div>
        </div>
        <div>
            <div class="nav_header">
                <i class='bx bx-cube icon'></i>
                <span>MCI Systems</span>
                <hr>
            </div>
            @foreach (config('menu') as $menuitem)
                <a href="{{$menuitem['url'][0]}}" class="link_menu">
                    <div class="nav_list {{ in_array($currentPath, $menuitem['url']) ? 'active' : '' }}">
                        <i class='{{ $menuitem['icon'] }} icon'></i>
                        <label>{{ $menuitem['name'] }}</label>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="nav_footer">
            <div class="img_frame">
                <img src="{{ asset('assets/img/empty_profile.jpg') }}">
            </div>
            <label>Username</label>
            <i class='bx bx-log-out icon'></i>
        </div>
    </div>
</div>
