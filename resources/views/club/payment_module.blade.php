@extends('layouts.all')


@section('content')
    @if(count($users))
     <table class="table">
    @foreach($users as $user)
       
            <tr>
                <td>{{ $user }}</td>
            </tr>
    @endforeach
    </table>

    @endif
@endsection