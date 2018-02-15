---
title: Quick Tips
sort_order: 2
image: jonathan-simcoe-88013.jpg
image_link: https://unsplash.com/photos/GxnyOLTxCr8
photographer: Jonathan Simcoe
---
@extends('_layouts.page')

@section('body')
	@foreach($tips->reverse() as $post)
		@include('_partials.post-listing-lg')
	@endforeach
@endsection
