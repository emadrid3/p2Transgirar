@extends('layouts.app')

@section('content')

@if ($vehicle != null)
    <view-manage-vehicles :vehicleprop="{{$vehicle}}"></view-manage-vehicles>
@else
    <view-manage-vehicles></view-manage-vehicles>
@endif
@endsection