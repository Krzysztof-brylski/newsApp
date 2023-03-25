
@extends('layouts.app')

@section('content')
<input type="hidden" id="relationId" value="{{$id}}">
<div class="container">
    <div id="relationContainer" class="d-flex flex-column align-items-center">

    </div>
</div>

@endsection
@vite(['resources/js/LiveRelations/readLiveRelations.js'])
