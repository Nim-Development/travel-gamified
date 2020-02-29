<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Cockpit</li>
                <li>
                    <a href="{{route('sales')}}" class="{{ (\Request::route()->getName() == 'sales') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Sales
                    </a>
                </li>
                <li class="app-sidebar__heading">Operations</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-plane"></i>
                        Trips
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="elements-buttons-standard.html">
                                <i class="metismenu-icon"></i>
                                All
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Teams
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>All
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Users
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>All
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-note"></i>
                        Answers
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Checked
                            </a>
                        </li>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Unchecked
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- SECTION: Game Development --}}
                <li class="app-sidebar__heading">Game Development</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-map-2"></i>
                        Tours
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li class="{{ (\Request::route()->getName() == 'tours') ? 'mm-active' : '' }}">
                            <a href="{{ route('tours') }}">
                                <i class="metismenu-icon"></i>
                                All
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="{{ (\Request::route()->getName() == 'tours.active') ? 'mm-active' : '' }}">
                            <a href="{{ route('tours.active') }}">
                                <i class="metismenu-icon"></i>
                                Active
                            </a>
                        </li>
                    </ul>
                    <ul>
                        <li class="{{ (\Request::route()->getName() == 'tours.inactive') ? 'mm-active' : '' }}">
                            <a href="{{ route('tours.inactive') }}">
                                <i class="metismenu-icon"></i>
                                Inactive
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-graph1"></i>
                        Itineraries
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>All
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-expand1"></i>
                        Playfields
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Cities
                            </a>
                        </li>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Transits
                            </a>
                        </li>
                        <li class="{{ (\Request::route()->getName() == 'routes') ? 'mm-active' : '' }}">
                            <a href="{{ route('routes') }}">
                                <i class="metismenu-icon">
                                </i>Routes
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-ball"></i>
                        Challenges
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Multiple choice
                            </a>
                        </li>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Text answere
                            </a>
                        </li>
                        <li>
                            <a href="components-tabs.html">
                                <i class="metismenu-icon">
                                </i>Media upload
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>