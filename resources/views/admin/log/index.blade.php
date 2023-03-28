@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action maker id: </th>
                <th scope="col">Action maker name: </th>
                <th scope="col">Action: </th>
                <th scope="col">Date: </th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <th>{{$log->id}}</th>
                    <th>{{$log->actionMaker->id}}</th>
                    <th>{{$log->actionMaker->name}}</th>
                    <th>{{$log->action}}</th>
                    <th>{{$log->created_at}}</th>
                </tr>
            @endforeach
        </tbody>
        {{$logs->links()}}
    </table>
</div>
@endsection
