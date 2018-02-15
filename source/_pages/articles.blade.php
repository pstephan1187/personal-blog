---
title: Articles
sort_order: 1
image: aaron-burden-90144.jpg
image_link: https://unsplash.com/photos/CKlHKtCJZKk
photographer: Aaron Burden
---
@extends('_layouts.page')

@section('body')
	@foreach($posts->reverse() as $post)
		@include('_partials.post-listing-lg')
	@endforeach
@endsection
