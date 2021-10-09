@extends('layouts.app')

@section('content')

@if ($user != null)
    <view-manage-users :userprop="{{$user}}"></view-manage-users>
@else
    <view-manage-users ></view-manage-users>
@endif
@endsection