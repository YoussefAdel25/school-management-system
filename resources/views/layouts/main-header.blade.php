<!--=================================
    header start-->
<nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <!-- Logo -->
    {{--  <div class="text-left navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}">
            <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="AlgoThorn Logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}">
            <img src="{{ URL::asset('assets/images/logo-icon-dark.png') }}" alt="AlgoThorn Logo Icon" />
        </a>
    </div>  --}}

    <!-- AlgoThorn Branding Text -->
    <!-- AlgoThorn Branding Text in a Circle -->
    <!-- AlgoThorn Branding Text in a Smaller Circle -->
    <!-- AlgoThorn Branding Text -->


    <div class="navbar-brand d-flex align-items-center ml-3">
        <div style="padding: 7px 20px; background: linear-gradient(135deg, #198754,#20c997); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
            <a href="{{ route('dashboard') }}">
                <h1 style="font-weight: bold; font-size: 20px; color: white; text-align: center; margin: 0; font-family: 'Arial', sans-serif;">
                    AlgoThorn Schools
                </h1>
            </a>
        </div>
    </div>



    <!-- Top bar left -->
    <ul class="nav navbar-nav mr-auto">
        <li class="nav-item">
            <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left" href="javascript:void(0);"><i
                    class="zmdi zmdi-menu ti-align-right"></i></a>
        </li>
        <li class="nav-item">
            <div class="search">
                <a class="search-btn not_click" href="javascript:void(0);"></a>
                <div class="search-box not-click">
                    <input type="text" class="not-click form-control" placeholder="Search" value=""
                        name="search">
                    <button class="search-button" type="submit"> <i class="fa fa-search not-click"></i></button>
                </div>
            </div>
        </li>
    </ul>

    <!-- Top bar right -->
    <ul class="nav navbar-nav ml-auto">
        <div class="btn-group mb-1">
            <button type="button" class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{ App::getLocale() == 'ar' ? asset('assets/images/flags/EG.png') : asset('assets/images/flags/US.png') }}"
                    alt="Flag" style="width: 20px; height: 15px; margin-right: 5px; vertical-align: middle;">
                {{ App::getLocale() == 'ar' ? 'AR' : 'EN' }}
            </button>

            <ul class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a class="dropdown-item d-flex align-items-center" rel="alternate"
                            hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            <img src="{{ $localeCode === 'ar' ? asset('assets/images/flags/EG.png') : asset('assets/images/flags/US.png') }}"
                                alt="Flag" style="width: 20px; height: 15px; margin-right: 8px;">
                            {{ $localeCode == 'ar' ? 'AR' : 'EN' }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <li class="nav-item fullscreen">
            <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
        </li>
        <li class="nav-item dropdown ">
            <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                aria-expanded="false">
                <i class="ti-bell"></i>
                <span class="badge badge-danger notification-status"> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                <div class="dropdown-header notifications">
                    <strong></strong>
                    <span class="badge badge-pill badge-warning">05</span>
                </div>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">New registered user <small
                        class="float-right text-muted time">Just now</small> </a>
                <a href="#" class="dropdown-item">New invoice received <small
                        class="float-right text-muted time">22 mins</small> </a>
                <a href="#" class="dropdown-item">Server error report<small class="float-right text-muted time">7
                        hrs</small> </a>
                <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                        days</small> </a>
                <a href="#" class="dropdown-item">Order confirmation<small class="float-right text-muted time">2
                        days</small> </a>
            </div>
        </li>
        <li class="nav-item dropdown mr-30">
            <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ URL::asset('assets/images/user_icon.png') }}" alt="avatar">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header">
                    <div class="media">
                        <div class="media-body">
                            <h5 class="mt-0 mb-0"></h5>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-secondary ti-reload"></i>Activity</a>
                <a class="dropdown-item" href="#"><i class="text-success ti-email"></i>Messages</a>
                <a class="dropdown-item" href="#"><i class="text-warning ti-user"></i>Profile</a>
                <a class="dropdown-item" href="#"><i class="text-dark ti-layers-alt"></i>Projects <span
                        class="badge badge-info">6</span> </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>Settings</a>

                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault();this.closest('form').submit();"><i class="bx bx-log-out"></i>تسجيل
                    الخروج</a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<!--=================================
    header End-->
