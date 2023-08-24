<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">

    <div class="navbar-header" style="width:92%;">
        <div class="col-lg-4">
            <a class="navbar-brand logo" href="#"><img src="themes/admin//images/2.png" height="40px"
                    width="200px" /> </a>
        </div>
        <div class="col-lg-8">
            <a class="navbar-brand logo" href="#"
                style="height: 25px; padding: 3px; color:white; font-size: 30px; width: 100%;text-align: center;"><strong>Welcome
                </strong> </a>
        </div>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">

        <!--<li><a href="#">Help</a></li>-->

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">

                <li><a href="index.php?component=address&action=edit"><i class="fa fa-users fa-fw"></i> Manage
                        Billing Address</a></li>

                <li><a href="index.php?component=user&action=changepassword"><i class="fa fa-lock fa-fw"></i>
                        Change Password</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default navbar-static-side" id="navbar-default" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="{{ route('home') }}"><!--<i class="fa fa-dashboard fa-fw"></i>--><i
                            class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
                </li>

                <li class="">
                    <a href="#"><!--<i class="glyphicon glyphicon-book"></i>--><i class="fa fa-product-hunt"
                            aria-hidden="true"></i> Products<span class="label label-important">5</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li style="border-top:1px solid white !important;">
                            <a href="{{ route('product_list') }}"><i class="fa fa-list-alt"></i>
                                List</a>
                        </li>
                        <li style="border-top:1px solid white !important;">
                            <a href="{{ route('add_product') }}"><i class="fa fa-plus-square"></i>
                                Add New</a>
                        </li>
                       
                    </ul>
                </li>
                <li>
                    <a href="#"><!--<i class="glyphicon glyphicon-book"></i>--><i class="fa fa-database"
                            aria-hidden="true"></i> Manage Receipt<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li style="border-top:1px solid white !important;">
                            <a href="{{ route('home') }}"><i class="fa fa-plus-square"></i>
                                Add New</a>
                        </li>
                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=add_order&action=list"><i class="fa fa-list-alt"></i>
                                List</a>
                        </li>
                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=add_order&action=cancel_list"><i
                                    class="fa fa-list-alt"></i> Cancel List</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="#"><i class="fa fa-database" aria-hidden="true"></i> Stock<span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">

                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=stock&action=add"><i class="fa fa-plus-square"></i> Add
                                New</a>
                        </li>
                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=stock&action=list"><i class="fa fa-list-alt"></i>
                                Availablle Stock</a>
                        </li>
                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=stock&action=stock_reports"><i
                                    class="fa fa-list-alt"></i> Purchased Stock</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="#"><i class="fa fa-flag" aria-hidden="true"></i> Report<span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=reports&action=sale_report"><i
                                    class="fa fa-list-alt"></i> Sale Report</a>
                        </li>
                        <li style="border-top:1px solid white !important;">
                            <a href="index.php?component=reports&action=list"><i class="fa fa-list-alt"></i>
                                General Report</a>
                        </li>
                    </ul>
                </li>

            </ul>
            <!-- /#side-menu -->
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>