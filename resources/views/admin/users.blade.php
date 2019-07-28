@extends('admin.layouts.gen')
@section('title', 'Glory Admin Panel')



@section('content')

<div id="app" style="width:80%; float:left;" :auth_user="{{Auth::user()->id }}">
    <users>

    </users>
</div>

@endsection

