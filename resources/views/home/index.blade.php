@extends('layouts/main')

@section('body')

    <nav>

        <div class="nav-wrapper">

            <div class="container">

                <a href="#" class="brand-logo">Infra</a>

            </div>

        </div>

    </nav>

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
                    <th>Wifi</th>
                    <th>Camera</th>
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
                        <td>Wifi</td>
                        <td>Camera</td>
                        <td>VLan</td>
                        <td>Sala Rack</td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

@endsection()