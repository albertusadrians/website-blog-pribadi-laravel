            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page"
                                href="/dashboard">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}"
                                href="/dashboard/posts">
                                <span data-feather="file-text" class="align-text-bottom"></span>
                                My Posts
                            </a>
                        </li>
                    </ul>
                    @can('admin')
                        <h6
                            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                            <span>Administrator</span>
                        </h6>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : '' }}"
                                    href="/dashboard/categories">
                                    <span data-feather="grid" class="align-text-bottom"></span>
                                    Post Categories
                                </a>
                            </li>
                        </ul>
                    @endcan
                    @if (auth()->user()->is_admin == 1)
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('dashboard/list-users*') ? 'active' : '' }}"
                                    href="/dashboard/list-users">
                                    <span data-feather="list" class="align-text-bottom"></span>
                                    List Users
                                </a>
                            </li>
                        </ul>
                    @endif
                </div>
            </nav>
