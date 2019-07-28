@extends('admin.layouts.gen')
@section('title', 'Glory Admin Panel')


@section('content')

<div id="app" >
<profile :id="{{ request()->route('id') }}" >

</profile>
</div>

@endsection