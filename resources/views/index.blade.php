@extends('template')
@section('view')
@php
function rupiah($angka)
{
$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
return $hasil_rupiah;
}
@endphp
<div class="row">
    @foreach($product as $products)
    <div class="col-3">
        <div class="card">
            <div class="card-body product">
                <img src="{{ asset('files').'/'.$products['image'] }}">
                <h5 class="card-title">{{ $products['name'] }}</h5>
                <h6>{{ rupiah($products['price']) }}</h6>
                <p class="card-text">{!! html_entity_decode(nl2br(e($products['description']))) !!}</p>
                <a href="#" class="btn btn-info"><i class="fas fa-shopping-cart-plus"></i> Beli</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection