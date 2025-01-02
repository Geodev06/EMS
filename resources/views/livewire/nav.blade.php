<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="/" class="az-logo">lspu.edu.ph</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="/" class="az-logo"><span></span> lspu.edu.ph</a>
                <a href="" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
                <li class="nav-item {{ Route::is('dashboard') ? 'active show' : ''   }}">
                    <a href="{{ route('dashboard') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('joined_events') }}" class="nav-link"><i class="typcn typcn-book"></i>Join Events</a>
                </li>
                @if(Auth::user()->role == 'ADMIN')
                <li class="nav-item {{ Route::is('organizer') ? 'active show' : ''}}">
                    <a href="{{ route('organizer') }} " wire:navigate class="nav-link"><i class="typcn typcn-user"></i> Organizers</a>
                </li>
                @endif
                @if(Auth::user()->role == 'ADMIN' || Auth::user()->role == 'ORGANIZER')
                <li class="nav-item {{ Route::is('events') ? 'active show' : ''}}">
                    <a href="{{ route('events') }}" wire:navigate class="nav-link"><i class="typcn typcn-calendar"></i> Events</a>
                </li>

                <li class="nav-item {{ Route::is('certificates') ? 'active show' : ''}}">
                    <a href="{{ route('certificates') }}"  class="nav-link"><i class="typcn typcn-star"></i> Certificates</a>
                </li>

                @endif

                @if(Auth::user()->role == 'ADMIN' || Auth::user()->role == 'ORGANIZER')
                <li class="nav-item">
                    <a href="form-elements.html" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Evaluations</a>
                </li>
                @endif

                <!-- <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-book"></i> Management</a>
                    <div class="az-menu-sub">
                        <div class="container">
                            <div>
                                <nav class="nav">
                                    <a href="elem-buttons.html" class="nav-link">Buttons</a>
                                    <a href="elem-dropdown.html" class="nav-link">Dropdown</a>
                                    <a href="elem-icons.html" class="nav-link">Icons</a>
                                    <a href="table-basic.html" class="nav-link">Table</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li> -->
            </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                    <p class="az-notification-text">You have 2 unread notification</p>
                    <div class="az-notification-list">
                        <div class="media new">
                            <div class="media-body">
                                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                <span>Mar 15 12:32pm</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media new">
                            <div class="media-body">
                                <p><strong>Joyce Chua</strong> just created a new blog post</p>
                                <span>Mar 13 04:16am</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                                <span>Mar 13 02:56am</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                                <span>Mar 12 10:40pm</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- az-notification-list -->
                    <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->
            <livewire:profilemenu />
        </div><!-- az-header-right -->
    </div><!-- container -->
</div>