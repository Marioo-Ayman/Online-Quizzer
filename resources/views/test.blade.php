@php
    $jsLinks = []; // file name
    $cssLinks = [];
    $pageTitle = 'test';
@endphp
<x-header :cssLinks="$cssLinks" :title="$pageTitle" />

{{-- your code here --}}
<div style=" height: 550px; background-color: gray;">

</div>

<x-footer :jsLinks="$jsLinks" />
