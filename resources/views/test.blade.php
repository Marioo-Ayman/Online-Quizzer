@php
    $jsLinks = []; // file name
    $cssLinks = [];
    $pageTitle = 'test';
@endphp

<x-header :cssLinks="$cssLinks" :title="$pageTitle" />


<div style=" height: 550px; background-color: gray;">

</div>

<x-footer :jsLinks="$jsLinks" />
