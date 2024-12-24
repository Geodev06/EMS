<div class="dropdown az-profile-menu">
    <a href="" class="az-img-user"><img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt=""></a>
    <div class="dropdown-menu">
        <div class="az-dropdown-header d-sm-none">
            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
        </div>
        <div class="az-header-profile">
            <div class="az-img-user">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="">
            </div><!-- az-img-user -->
            <h6>{{ Auth::user()->first_name ?? '' }} {{ Auth::user()->last_name ?? '' }}</h6>
            <span>Participant</span>
        </div><!-- az-header-profile -->

        <a href="{{ route('profile') }}" wire:navigate class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
        <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
        <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
        <a href="#" class="dropdown-item" wire:click="logout"><i class="typcn typcn-power-outline"></i> Sign Out</a>
    </div><!-- dropdown-menu -->
</div>