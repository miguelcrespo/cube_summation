@extends('layouts.master')

@section('content')
    <ul>
        <li v-for="comando in comandos">
            <span>@{{ comando.text }}</span><br>
            <span> > @{{ comando.response }}</span><br>
            <small>@{{comando.date}}</small>
        </li>
    </ul>


    <form action="#" novalidate>
        <div id="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="exampleInputEmail1">Comando</label>
                    <input :disabled="actions >= cube.m" type="text" v-model="newCommand" class="form-control" id="exampleInputEmail1"
                           placeholder="Insertar comando...">
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success" :disabled="newCommand === ''" v-if="actions < cube.m" v-on:click="enviarComando">Enviar</button>
                <button class="btn btn-success" v-if="actions >= cube.m" v-on:click="resetCube">Reset</button>
            </div>
    </form>

    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" novalidate>
                    <div class="modal-header">
                        <h4 class="modal-title">Configura el cubo</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tests <span v-if="tests>0">@{{ tests + 1 }} de @{{ cube.t }}</span> </label>
                            <input type="number" v-model="cube.t" class="form-control" id="exampleInputEmail1"
                                   placeholder="" :disabled="tests!==0 && tests < cube.t">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">N Matrix</label>
                            <input type="number" v-model="cube.n" class="form-control" id="exampleInputEmail1"
                                   placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">N Comandos</label>
                            <input type="number" v-model="cube.m" class="form-control" id="exampleInputEmail1"
                                   placeholder="">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" v-on:click="config" class="btn btn-primary">Configurar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->



    <script>
        @if (!$matrix)
                window.showModal = true;
        @endif
    </script>

@endsection



