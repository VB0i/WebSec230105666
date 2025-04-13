@extends('layouts.master')

@section('title','Multibication')

@section('content')

<div class="container">
    <div class="row">
        @for ($j = 1; $j <= 10; $j++)
        <div class="card m-4 col-sm-2">
            <div class="card-header">multiblecation table {{$j}}</div>
            <div class="card-body">
                <table class="table">
                    @for ($i = 1; $i <= 10; $i++)
                    <tr>
                                    <td>{{$i}} * {{$j}}</td>
                                    <td> = {{ $i * $j }}</td>
                                </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>

@endsection