<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ access()->user()->picture }}" class="img-circle" alt="User Image" />
            </div><!--pull-left-->
            <div class="pull-left info">
                <p>{{ access()->user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div><!--pull-left-->
        </div><!--user-panel-->

        <!-- search form (Optional) -->
        {{ Form::open(['route' => 'admin.search.index', 'method' => 'get', 'class' => 'sidebar-form']) }}
        <div class="input-group">
            {{ Form::text('q', Request::get('q'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => trans('strings.backend.general.search_placeholder')]) }}

            <span class="input-group-btn">
                    <button type='submit' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span><!--input-group-btn-->
        </div><!--input-group-->
    {{ Form::close() }}
    <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/category')) }}">
                <a href="{{ route('admin.category.index') }}">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span>Manage Category</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/product')) }}">
                <a href="{{ route('admin.product.index') }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <span>Manage Products</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/order')) }}">
                <a href="{{ route('admin.order.index') }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <span>Manage Orders</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/content')) }}">
                <a href="{{ route('admin.content.index') }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <span>Manage Content</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/schedule')) }}">
                <a href="{{ route('admin.schedule.index') }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <span>Manage Show Schedule</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/login-banners')) }}">
                <a href="{{ route('admin.login-banners.index') }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <span>Manage Banners</span>
                </a>
            </li>

            <li class="{{ active_class(Active::checkUriPattern('admin/settings')) }}">
                <a href="{{ route('admin.settings.index') }}">
                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                    <span>Manage Settings</span>
                </a>
            </li>
            
            @role(1)
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.users.management') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/tiers')) }}">
                        <a href="{{ route('admin.tiers.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Manage Tiers</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user/manage-tier')) }}">
                        <a href="{{ route('admin.access.manage-tier') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>Tier Permission Manager</span>
                        </a>
                    </li>

                    {{-- <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li> --}}


                </ul>
            </li>
            @endauth

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>