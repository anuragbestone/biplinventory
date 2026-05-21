@if(Session("role_id") == 3)
    @include("layouts.partials.wheader")
    @include("layouts.partials.wtopnav")
@else
    @include("layouts.partials.aheader")
    @include("layouts.partials.atopnav")
@endif

@yield("mainContent")

@if(Session("role_id") == 3)
    @include("layouts.partials.wfooter")
@else
    @include("layouts.partials.afooter")
@endif