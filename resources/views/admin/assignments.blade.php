@extends('admin.layouts.gen')
@section('title', 'Glory Admin Panel')


@section('content')

<div id="app" >
    <assignments :auth_user="{{Auth::user()->id }}" >

    </assignments>
</div>

@endsection