@extends('layouts.app')

@section('content')
<view-vehicles :auth="{{$auth}}"></view-vehicles>
@endsection