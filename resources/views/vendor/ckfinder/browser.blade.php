@extends('admin.index')
@include('ckfinder::setup')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div id="object"></div>
        <div id="Object"></div>
    </div>
</div>
<script>
    CKFinder.widget('object',{
            width:'100%',
            height: 1000,
        });
</script>