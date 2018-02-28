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

    <div class="row section">

        <div class="col offset-s1 offset-m1 offset-l1 s10 m10 l10">

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

                @foreach($patches['data'] as $p)

                    <tr>

                        <td>{{ $p['build'] }}</td>
                        <td>{{ $p['floor'] }}</td>
                        <td>{{ $p['room'] }}</td>
                        <td>{{ $p['patchPort'] }}</td>
                        <td>{{ $p['status'] }}</td>
                        <td>{{ $p['switchHostname'] }}</td>
                        <td>{{ $p['switchIP'] }}</td>
                        <td>{{ $p['switchIdentification'] }}</td>
                        <td>{{ $p['switchPort'] }}</td>
                        <td>{{ $p['service'] }}</td>
                        <td>{{ $p['switchVlan'] }}</td>
                        <td>{{ $p['rackLocation'] }}</td>

                    </tr>

                @endforeach

                </tbody>

            </table>


            <ul class="pagination center-align">

                @if(array_key_exists('previous', $pagination['links']))

                    <li class="waves-effect">

                        <a href="{{ $pagination['links']['previous'] }}">

                            <i class="material-icons">chevron_left</i>

                        </a>

                    </li>

                @else

                    <li class="disabled">

                        <a href="#!">

                            <i class="material-icons">chevron_left</i>

                        </a>

                    </li>

                @endif

                @for($patch = 1; $patch <= $pagination['total_pages']; $patch ++)

                    <li class="{{ $pagination['current_page'] === $patch ? 'active':'waves-effect' }}">

                        <a href="?page={{ $patch }}">

                            {{ $patch }}

                        </a>

                    </li>

                @endfor

                @if(array_key_exists('next', $pagination['links']))

                    <li class="waves-effect">

                        <a href="{{ $pagination['links']['next'] }}">

                            <i class="material-icons">chevron_right</i>

                        </a>

                    </li>

                @else

                     <li class="disabled">

                         <a href="#!">

                             <i class="material-icons">chevron_right</i>

                         </a>

                     </li>

                @endif

            </ul>

        </div>


    </div>


@endsection()