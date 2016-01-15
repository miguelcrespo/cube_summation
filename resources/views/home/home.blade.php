@extends('layouts.master')

@section('content')
    Pantalla principal


    <div class="modal fade" tabindex="-1" role="dialog" id="myModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" novalidate>
                    <div class="modal-header">
                        <h4 class="modal-title">Configura el cubo</h4>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tests</label>
                            <input type="number" v-model="cube.tests" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">N Matrix</label>
                            <input type="number" v-model="cube.matrix" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">N Comandos</label>
                            <input type="number" v-model="cube.m" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" v-on:click="config" class="btn btn-primary">Configurar</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

