@extends('layouts.all')


@section('content')
    @if(count($users))
    @foreach($users as $user)
        <table>
            <tr>
                <td>{{ $user }}</td>
            </tr>
        </table>
    @endforeach
    @endif
@endsection