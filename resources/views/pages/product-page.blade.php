@extends('layout.sidenav-layout')
@section('content')
    @include('component.product.index')
    @include('component.product.delete')
    @include('component.product.create')
    @include('component.product.edit')
@endsection
