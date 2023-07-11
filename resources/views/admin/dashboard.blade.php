@extends('admin.layouts.app')

@section('content')


<h1 class="ttext-xl tfont-medium tml-8">Expenses: {{ number_format($expense) }}</h1>
<h1 class="ttext-xl tfont-medium tml-20">+</h1>
<h1 class="ttext-xl tfont-medium tml-8">Purchase: {{ number_format($purchase) }}</h1>
<h1 class="ttext-xl tfont-medium tml-20">+</h1>
<h1 class="ttext-xl tfont-medium tml-8">Power Up: {{ number_format($power_up_total) }} <small>(Total Sf: {{ $power_up_sf }})</small></h1>

------------------------
<h1 class="ttext-2xl tfont-medium">Total Expense: {{ number_format($purchase + $expense + $power_up_total) }}</h1>

@endsection