@extends('admin.layouts.app')
@section('title','Edit '.$post->title.' · Content Studio')
@section('breadcrumb','Journal / Edit')
@section('content-class','!p-0 bg-[#F7F5EF]')
@section('content')
@include('admin.posts._editor',['post'=>$post])
@endsection