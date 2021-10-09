@extends('layouts.app')

@section('content')

<h1 style="color: gray; font-size:350%; margin: 0px;">TRANS<b style="color: green;">GIRAR</b></h1>
<h2 style="color: green; font-size:250%;">BIENVENIDOS AL SISTEMA!</b></h2>
<view-home></view-home>

<br>


<div style="display: flex; justify-content: space-between; flex-wrap: wrap;">
  <div style="display: flex; flex-direction">
    <div style="background-color: #ECECEC; padding: 10px; display: flex; flex-direction: column; justify-content: center;     border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
      <i class="fas fa-route fa-4x" style="color:orange"></i>
    </div>
    <div style="display: flex; flex-direction: column; padding: 10px; border: 2px solid #ECECEC;">
      <span>Total viajes mes</span>
      <h2><b style="font-size: 40px;">250</b></h2>
    </div>
  </div>
  <div style="display: flex; flex-direction">
    <div style="background-color: #ECECEC; padding: 10px; display: flex; flex-direction: column; justify-content: center;     border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
      <i class="fas fa-file-invoice-dollar fa-4x" style="color: green;"></i>
    </div>
    <div style="display: flex; flex-direction: column; padding: 10px; border: 2px solid #ECECEC;">
      <span>Facturas pagas</span>
      <h2><b style="font-size: 40px;">250</b></h2>
    </div>
  </div><div style="display: flex; flex-direction">
    <div style="background-color: #ECECEC; padding: 10px; display: flex; flex-direction: column; justify-content: center;     border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
      <i class="fas fa-file-invoice-dollar fa-4x" style="color: red;"></i>
    </div>
    <div style="display: flex; flex-direction: column; padding: 10px; border: 2px solid #ECECEC;">
      <span>Facturas pendientes</span>
      <h2><b style="font-size: 40px;">250</b></h2>
    </div>
  </div><div style="display: flex; flex-direction">
    <div style="background-color: #ECECEC; padding: 10px; display: flex; flex-direction: column; justify-content: center;     border-top-left-radius: 20px; border-bottom-left-radius: 20px;">
      <i class="fas fa-wallet fa-4x" style="color: blue;"></i>
    </div>
    <div style="display: flex; flex-direction: column; padding: 10px; border: 2px solid #ECECEC;">
      <span>Total facturación</span>
      <h2><b style="font-size: 40px;">$5'000.000</b></h2>
    </div>
  </div>
</div>

@endsection
