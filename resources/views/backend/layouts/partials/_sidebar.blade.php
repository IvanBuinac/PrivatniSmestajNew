<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{route("dashboard")}}"><i class="fa fa-home"></i> {{trans("site.dashboard")}}</a></li>
                <li><a><i class="fa fa-edit"></i>{{trans("site.accomodation")}} <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">

                        <li><a href="{{route("accommodation.index")}}">{{trans("site.accomodation")}}</a></li>


                        <li><a href="{{route("accommodation-unit.index")}}">{{trans("site.accomodation-unit")}}</a></li>


                    </ul>
                </li>
                @role('admin')
                <li><a><i class="glyphicon glyphicon-user"></i>{{trans("user.user")}}<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("users.index")}}">{{trans("user.user")}}</a></li>
                        <li><a href="{{route("permissions.index")}}">{{trans("user.permission")}}</a></li>
                        <li><a href="{{route("roles.index")}}">{{trans("user.roles")}}</a></li>
                    </ul>
                </li>
                <li><a><i class="glyphicon glyphicon-briefcase"></i> {{trans("site.accomodationothertings")}} <span class="fa f-chevron-downa"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("categories.index")}}">{{trans("site.categories")}}</a></li>
                        <li><a href="{{route("characteristics.index")}}">{{trans("site.characteristics")}}</a></li>
                        <li><a href="{{route("distance.index")}}">{{trans("site.distances")}}</a></li>
                        <li><a href="{{route("payment.index")}}">{{trans("site.payments")}}</a></li>
                        <li><a href="{{route("period.index")}}">{{trans("site.period")}}</a></li>
                        <li><a href="{{route("renting.index")}}">{{trans("site.renting")}}</a></li>
                        <li><a href="{{route("species.index")}}">{{trans("site.species")}}</a></li>
                        <li><a href="{{route("types.index")}}">{{trans("site.type")}}</a></li>
                    </ul>
                </li>
                <li><a><i class="glyphicon glyphicon-globe"></i> Location <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route("state.index")}}">{{trans("site.state")}}</a></li>
                        <li><a href="{{route("city.index")}}">{{trans("site.city")}}</a></li>
                    </ul>
                </li>
                @endrole
        </ul>
    </div>
    <div class="menu_section">
        <h3>Live On</h3>
        <ul class="nav side-menu">

        </ul>
    </div>

</div>