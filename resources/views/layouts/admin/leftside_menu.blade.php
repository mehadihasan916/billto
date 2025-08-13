            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title" key="t-menu">Menu</li>

                            <li>
                                <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                                    <i class="bx bx-home-circle"></i>
                                    <span key="t-dashboards">Dashboards</span>
                                </a>

                            </li>

                            {{-- package --}}

                             {{-- manage template --}}
                             <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-package"></i>
                                    <span key="t-dashboards">Manage Template</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('admin/manage/template/page') }}" key="t-horizontal">Add tamplate</a></li>
                                        {{-- <li><a href="{{ url('admin/') }}" key="t-horizontal">Organization Package
                                            list</a></li> --}}
                                </ul>
                            </li>
                            {{-- Subscription package --}}
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-package"></i>
                                    <span key="t-dashboards">Subscription Package</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('admin/package/page') }}" key="t-horizontal">Subscription package create</a></li>
                                    <li><a href="{{ url('admin/package/list') }}" key="t-horizontal">Subscription package list</a></li>
                                </ul>
                            </li>
                            {{-- Organization package --}}
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-package"></i>
                                    <span key="t-dashboards">Organizatin Package</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('admin/organization/package/page') }}" key="t-horizontal">Organization package
                                        create</a></li>
                                        <li><a href="{{ url('admin/organization/package/list') }}" key="t-horizontal">Organization Package
                                            list</a></li>
                                </ul>
                            </li>
                            {{-- Organization package --}}
                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-package"></i>
                                    <span key="t-dashboards">User Document</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ url('admin/docoment/create') }}" key="t-horizontal">Document type
                                        create</a></li>
                                        {{-- <li><a href="{{ url('admin/organization/package/list') }}" key="t-horizontal">Organization Package
                                            list</a></li> --}}
                                </ul>
                            </li>
                            {{-- Users --}}
                            <li>
                                <a href="{{ route('admin.users') }}" class="waves-effect">
                                    <i class="bx bx-user"></i>
                                    <span key="t-dashboards">Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.invoice') }}" class="waves-effect">
                                    <i class="bx bx-receipt"></i>
                                    <span key="t-dashboards">Invoice</span>
                                </a>
                            </li>

                            {{-- <li class="menu-title" key="t-apps">Apps</li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect">
                                    <i class="bx bx-calendar"></i><span
                                        class="badge rounded-pill bg-success float-end">New</span>
                                    <span key="t-dashboards">Calendars</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="calendar.html" key="t-tui-calendar">TUI Calendar</a></li>
                                    <li><a href="calendar-full.html" key="t-full-calendar">Full Calendar</a></li>
                                </ul>
                            </li> --}}



                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
