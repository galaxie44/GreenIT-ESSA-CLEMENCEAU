@extends('layouts.app')

@section('content')
    <main class="container mt-4">
        @if(count($items))
            <h2 class='mr-auto'> votre commande </h2>
            <table class='table table-striped table-hover'>
                <tr>
                    <th>nom</th>
                    <th>description</th>
                    <th>prix unitaire</th>
                    <th>quantite</th>
                    <th>prix total</th>
                    <th></th>
                </tr>
                @foreach($items as $row)
                    <tr>
                        <td>{{ $row['article']->titre }}</td>
                        <td>{{ $row['article']->description }}</td>
                        <td>{{ $row['article']->prix }}</td>
                        <td>{{ $row['qty'] }}</td>
                        <td>{{ $row['line_total'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove') }}" method="post">
                                @csrf
                                <input type="hidden" name="article_id" value="{{ $row['article']->id }}">
                                <input type="submit" value="retire un">
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>prix totale</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $total }}</td>
                    <td></td>
                </tr>
            </table>
            <a href="{{ route('payment.show') }}" class="btn btn-primary mr-auto" id="payer"> payer</a>
        @else
            <h2><center><p> le panier est vide </p></center></h2>
        @endif
    </main>
@endsection

