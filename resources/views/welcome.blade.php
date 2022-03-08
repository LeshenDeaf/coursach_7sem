@extends('layouts.app')

@section('content')
    <h1>Test</h1>
    {{ \App\Models\User::take(1)->with('roles')->where('id', 11)->get() }}
    <br>
    <br>
    {{ \App\Models\Role::take(1)->with('users')->where('id', 1)->get() }}
@endsection
