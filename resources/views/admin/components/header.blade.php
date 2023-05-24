<style>
    .navbar-brand {
        padding: 0px 20px;
    }

    .navbar-brand>img {
        height: 41px;
    }
</style>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header" style="background-color: white;">
        <a class="navbar-brand " href="{{ route('dashboard') }}"
            style="color:#263238;font-size:20px;padding:12px;font-weight:bold;width:100%;text-align:center;">
            {{ getSite('site_name') }}
        </a>
        <ul class="nav navbar-nav visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a>
            </li>
        </ul>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="icon-user"></i><span>Akun</span><i class="caret"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" style="min-width: 235px;">
                        <li>
                            <a href="{{ route('logout') }}" class="btn-logout"><i class="icon-exit3"></i>Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
