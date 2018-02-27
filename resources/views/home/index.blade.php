@extends('layouts/main')

@section('body')

    <div class="navbar-fixed">

        <nav>

            <div class="nav-wrapper">

                <div class="container">

                    <a href="#" class="brand-logo">Infra IAG</a>

                </div>

            </div>

        </nav>

    </div>

    <div class="container">

        <table class="bordered highlight">

            <thead>

                <tr>

                    <th>Bloco</th>
                    <th>Andar</th>
                    <th>Sala</th>
                    <th>Ponto</th>
                    <th>Status</th>
                    <th>Hostname</th>
                    <th>Ip</th>
                    <th>Switch</th>
                    <th>Porta Switch</th>
                    <th>Serviço</th>
                    <th>VLan</th>
                    <th>Sala Rack</th>

                </tr>

            </thead>

            <tbody>

                @foreach($patches as $p)

                    <tr>

                        <td>{{ $p->local->build }}</td>
                        <td>{{ $p->local->floor }}</td>
                        <td>{{ $p->local->local }}</td>
                        <td>{{ $p->numero }}</td>
                        <td>A</td>
                        <td>Hostname</td>
                        <td>Ip</td>
                        <td>Switch</td>
                        <td>Porta Switch</td>
                        <td>Serviço - wifi ou camera</td>
                        <td>VLan</td>
                        <td>Sala Rack</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endsection()