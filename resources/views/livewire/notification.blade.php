<div class="dropdown az-header-notification">
    <a href="" class="new"><i class="typcn typcn-bell"></i></a>
    <div class="dropdown-menu">
        <div class="az-dropdown-header mg-b-20 d-sm-none">
            <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
        </div>
        <h6 class="az-notification-title">Notifications</h6>
        @if($unread_count > 0)
        <p class="az-notification-text">You have {{ $unread_count ?? 0 }} unread notification</p>

        @endif
        <div class="az-notification-list">
            @forelse($notifications as $item)
            <div class="media new" @click="$dispatch('seen', { id : {{ $item->id}} } )">
                <div class="media-body">
                    <p>{{ $item->message ?? '' }}</p>
                    <span>{{ $item->created_at->diffForHumans() }}</span>
                </div><!-- media-body -->
            </div><!-- media -->
            @empty
            <div class="media new">
                <div class="media-body">
                    <p>No Notifications</p>
                </div><!-- media-body -->
            </div><!-- media -->
            @endforelse
        </div><!-- az-notification-list -->
        
    </div><!-- dropdown-menu -->
</div>