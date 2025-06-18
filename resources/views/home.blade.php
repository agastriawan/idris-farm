@extends('layouts.app')

@section('title', 'Beranda - UMKash')

@section('content')
    @include('sections.hero')
    @include('sections.katalog')
    @include('sections.gallery')
    @include('sections.counter')
    @include('sections.about')
    @include('sections.service')
    @include('sections.artikel')
    @include('sections.testimoni')
    @include('sections.kontak')
@endsection
