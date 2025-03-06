{{--@if(Aaran\Aadmin\Src\Customise::hasEntries())--}}
{{--    <x-aaran-ui::menu.base.li-menuitem :routes="'sales'" :label="'Sales'"/>--}}
{{--@endif--}}
{{--@if(Aaran\Aadmin\Src\Customise::hasExportSales())--}}
{{--<x-aaran-ui::menu.base.li-menuitem :routes="'exportsales'" :label="'Export Sales'"/>--}}
{{--@endif--}}
{{--@if(Aaran\Aadmin\Src\Customise::hasEntries())--}}
{{--<x-aaran-ui::menu.base.li-menuitem :routes="'purchase'" :label="'Purchase'"/>--}}
{{--@endif--}}
{{--<x-aaran-ui::menu.base.route-menuitem  href="{{route('transactions',[1])}}" :label="'Receipt'"/>--}}
{{--<x-aaran-ui::menu.base.route-menuitem  href="{{route('transactions',[2])}}" :label="'Payment'"/>--}}

<x-aaran-ui::menu.app.base.li-menuitem :routes="'sales'" :label="'Sales'"/>
<x-aaran-ui::menu.app.base.li-menuitem :routes="'purchase'" :label="'Purchase'"/>
<x-aaran-ui::menu.app.base.li-menuitem :routes="'exportsales'" :label="'Export Sales'"/>


