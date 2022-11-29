<div id="menubar" class="menubar-inverse">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="#">
                <span class="text-lg text-bold text-primary">{{ config('app.name', 'PSMS')}}</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">

            <!-- BEGIN DASHBOARD -->
            <li>
                <a href="{{ route('home')}}" >
                    <div class="gui-icon"><i class="md md-home"></i></div>
                    <span class="title text-uppercase">{{ __('Dashboard')}}</span>
                </a>
            </li><!--end /menu-li -->
            <!-- END DASHBOARD -->

            <!-- BEGIN Directions -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-playlist-add"></i></div>
                    <span class="title text-uppercase">{{ __('Directions')}}</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ route('provinces.index')}}"  {{ request()->routeIs('provinces.index')?'class=active':'' }} ><span class="title text-uppercase">{{ __('Liste')}}</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END Directions -->


            <!-- BEGIN ETABS -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-people"></i></div>
                    <span class="title text-uppercase">{{ __('Etablissements')}}</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ route('etabs.index')}}" {{ request()->routeIs('etabs.index')?'class=active':'' }}><span class="title text-uppercase">{{__('Liste')}}</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END ETABS -->


            <!-- BEGIN USERS -->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="md md-person"></i></div>
                    <span class="title text-uppercase">{{ __('Users') }}</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ route('users.index')}}" {{ request()->routeIs('users.index')?'class=active':'' }}><span class="title text-uppercase">{{__('Users List')}}</span></a></li>
                    <li><a href="{{ route('users.create')}}" {{ request()->routeIs('users.create')?'class=active':'' }}><span class="title text-uppercase">{{__('New User')}}</span></a></li>
                </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END USERS -->

             <!-- BEGIN SETTING -->
             <li>
                <a href="{{ route('settings')}}" >
                    <div class="gui-icon"><i class="md md-settings"></i></div>
                    <span class="title text-uppercase">{{ __('Settings')}}</span>
                </a>
            </li><!--end /menu-li -->
            <!-- END SETTING -->

        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-50">{{ __('© AREF de l\'Oriental') }} 2022</span>
            </small>
        </div>
    </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
