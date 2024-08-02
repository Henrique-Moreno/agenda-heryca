@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

@php
    $configData = Helper::appClasses();
@endphp

@isset($configData["layout"])
    @php
        $layout = $configData["layout"];
        $layoutFile = match ($layout) {
            'horizontal' => 'layouts.horizontalLayout',
            'blank' => 'layouts.blankLayout',
            'front' => 'layouts.layoutFront',
            default => 'layouts.contentNavbarLayout',
        };
    @endphp
    @include($layoutFile)
@endisset
