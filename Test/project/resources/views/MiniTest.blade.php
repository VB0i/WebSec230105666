@extends('layouts.master')

@section('title', 'Super Market')

@section('content')
<div class="container text-center mt-5">
        <p class="h1">Super Market Bill's</p>
    </div>
    <table class="table">
  <thead>
    <tr class="table-warning" >
      <th scope="col">Item</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Jam</th>
      <td>1</td>
      <td>12.50</td>
      <td>12.50</td>
    </tr>
    <tr>
      <th scope="row">tea</th>
      <td>3</td>
      <td>32.00</td>
      <td>96.00</td>
    </tr>
    <tr>
      <th scope="row">banana</th>
      <td>5</td>
      <td>2.20</td>
      <td>11.00</td>
    </tr>
    <tr>
      <th scope="row">Rice</th>
      <td>2</td>
      <td>15.75</td>
      <td>31.50</td>
    </tr>
  </tbody>
</table>
@endsection