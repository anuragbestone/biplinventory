@if(Session("role_id") == 3)
    @include("layouts.partials.wheader")
    @include("layouts.partials.wtopnav")
@elseif (Session("role_id") == 4)
    @include("layouts.partials.sheader")
    @include("layouts.partials.stopnav")
@else
    @include("layouts.partials.aheader")
    @include("layouts.partials.atopnav")
@endif

@yield("mainContent")

@if(Session("role_id") == 3)
    @include("layouts.partials.wfooter")
@elseif (Session("role_id") == 4)
    @include("layouts.partials.sfooter")
@else
    @include("layouts.partials.afooter")
@endif