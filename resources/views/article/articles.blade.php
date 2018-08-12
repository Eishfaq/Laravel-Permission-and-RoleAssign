@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    	@include('admin.sidebar')
    	<div class="col-md-9">
    		<div id="app">
    			<articles></articles>
    		</div>
    	</div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@endsection