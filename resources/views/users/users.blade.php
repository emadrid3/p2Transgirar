@extends('layouts.app')

@section('content')
<view-users :auth="{{$auth}}"></view-users>
@endsection