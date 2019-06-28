@extends('layouts.all')


@section('content')
    @if(count($users))
     <table class="table">
    @foreach($users as $user)
       
            <tr>
                <td>{{ $user }}</td>
            </tr>
            <tr>
                <td>{{ $user->payments2 }}</td>
            </tr>
            <tr>
                <td>{{ $user->payments }}</td>
            </tr>
    @endforeach
    </table>

    @endif
@endsection