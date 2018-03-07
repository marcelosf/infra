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

        <div class="col offset-s1 offset-m1 offset-l1 s10 m10 l10 z-depth-1">

            <a class="waves-effect waves-light btn-flat modal-trigger right" href="#modal">

                <i class="material-icons left">search</i>Busca

            </a>


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

        @component('components.modal')

            @slot('content')

                <div class="row">

                    <form class="col s12" id="home-form" method="get" action="?search">

                        <div class="row">

                            <div class="section">

                                <h5>Busca</h5>

                                <div class="divider"></div>

                                <br>

                                <div class="input-field col s4 m4">

                                    <select name="build" id="build">

                                        <option></option>

                                    </select>

                                    <label for="build">Bloco</label>

                                </div>

                                <div class="input-field col s4 m4" id="field-floor">

                                    <select name="floor" id="floor">

                                        <option></option>

                                    </select>

                                    <label for="floor">Andar</label>

                                </div>

                                <div class="input-field col s4 m4">

                                    <select name="room" id="room">

                                        <option></option>

                                    </select>

                                    <label for="room">Sala</label>

                                </div>

                                <div class="input-field col s3">

                                    <input type="text" id="patch" name="patch" class="validate">

                                    <label for="patch">Ponto</label>

                                </div>

                                <div class="input-field col s3">

                                    <input type="text" id="status" name="status" class="validate">

                                    <label for="status">Status</label>

                                </div>

                                <div class="input-field col s3">

                                    <input type="text" id="device" name="device" class="validate">

                                    <label for="device">Serviço</label>

                                </div>

                                <div class="input-field col s3">

                                    <input type="text" id="rack-room" name="rack-room" class="validate">

                                    <label for="rack-room">Sala do Rack</label>

                                </div>

                                <div class="input-field col s3">

                                    <input type="text" id="hostname" name="hostname" class="validate">

                                    <label for="hostname">Hostname</label>

                                </div>

                                <div class="input-field col s3">

                                    <input type="text" id="ip" name="ip" class="validate">

                                    <label for="ip">IP</label>

                                </div>

                                <div class="input-field col s2">

                                    <input type="text" id="switch" name="switch" class="validate">

                                    <label for="switch">Switch</label>

                                </div>

                                <div class="input-field col s2">

                                    <input type="text" id="switch-port" name="switch-port" class="validate">

                                    <label for="switch-port">Porta Switch</label>

                                </div>

                                <div class="input-field col s2">

                                    <input type="text" id="vlan" name="vlan" class="validate">

                                    <label for="vlan">VLAN</label>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            @endslot

            @slot('footer')

                    <div class="waves-effect btn white black-text" id="search-close">

                        <i class="material-icons left">close</i>
                        Fechar

                    </div>

                    <div class="waves-effect btn" id="search-submit">

                        <i class="material-icons left">search</i>
                        Buscar

                    </div>

            @endslot

        @endcomponent

    </div>


@endsection()