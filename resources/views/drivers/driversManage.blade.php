@extends('layouts.app')

@section('content')

@if ($driver != null)
    <view-manage-drivers :driverprop="{{$driver}}"></view-manage-drivers>
@else
    <view-manage-drivers></view-manage-drivers>
@endif
@endsection