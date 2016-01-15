/**
 * Created by Miguel on 1/14/16.
 */

$('#myModal').modal('show');

var vm = new Vue({
    el: '#main',
    data: {
        cube: {
            t: '',
            n: '',
            m: ''
        },
        comandos: []
    },
    // define methods under the `methods` object
    methods: {
        config: function (e) {
            e.preventDefault();

            if (!vm.cube.tests || !vm.cube.matrix || !vm.cube.m) {
                return alert("Por favor completa el formulario!");
            }


            $('#myModal').modal('hide');


        }
    }
});