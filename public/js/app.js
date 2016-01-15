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
        comandos: [
            {
                text: "UPDATE 1 1 1 2",
                date: new Date(),
                response: "Ok"
            },
            {
                text: "QUERY  1 1 1 2 2 2 ",
                date: new Date(),
                response: "23"
            }
        ],
        newCommand: ''
    },
    // define methods under the `methods` object
    methods: {
        /**
         * Configura el cubo con la informacion introduccida en el modal
         * @param e Evento del submit
         */
        config: function (e) {
            e.preventDefault();

            if (!vm.cube.tests || !vm.cube.matrix || !vm.cube.m) {
                return alert("Por favor completa el formulario!");
            }


            $('#myModal').modal('hide');


        },
        /**
         * Envia un comando al servidor y procesa su respuesta
         * @param e Evento que lo invoco
         */
        enviarComando: function (e) {
            // Este metodo enviara la informacion al servidor cuando este se haya implementado...
            vm.comandos.push({text: vm.newCommand, date: new Date(), response: "Fake response"});
            vm.newCommand = "";
        }
    }
});