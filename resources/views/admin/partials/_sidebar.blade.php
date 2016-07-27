<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            @unless(\Auth::user() == null)
                <p>{{ \Auth::user()->first_name  }} {{ \Auth::user()->last_name }}</p>
            @endunless
            {{--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
        </div>
    </div>
    <!-- search form -->
    {{--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
        </div>
    </form>--}}
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
            <a href="/">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
            </a>
        </li>
        @if(\Auth::user() != null && \Auth::user()->is_admin)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/auth/register"><i class="fa fa-circle-o"></i>User registration</a></li>
                    <li><a href="/users"><i class="fa fa-circle-o"></i>All users</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i>
                    <span>Imports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/upload"><i class="fa fa-circle-o"></i>Upload</a></li>
                </ul>
            </li>
        @endif
    </ul>
</section>
<!-- /.sidebar -->