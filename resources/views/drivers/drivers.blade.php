@extends('layouts.app')

@section('content')
<view-drivers :auth="{{$auth}}"></view-drivers>
@endsection