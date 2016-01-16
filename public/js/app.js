/**
 * Created by Miguel on 1/14/16.
 */


if (window.showModal) {
    $('#myModal').modal('show');
}

var updateActions = function () {
    vm.actions += 1;
    if (vm.actions >= vm.cube.m) {
        vm.tests += 1;
    }

    if (vm.tests >= vm.cube.t) {
        vm.tests = 0;
    }
};

var processErrorMessages = function (response) {
    if (response.responseJSON.error) {
        alert(response.responseJSON.error);
    } else {
        var keys = Object.keys(response.responseJSON);
        alert("Hay errores en los campos: " + keys);
    }

};

var vm = new Vue({
    el: '#main',
    data: {
        cube: {
            t: '',
            n: '',
            m: ''
        },
        comandos: [],
        newCommand: '',
        actions: 0,
        tests: 0
    },
    // define methods under the `methods` object
    methods: {
        /**
         * Configura el cubo con la informacion introduccida en el modal
         * @param e Evento del submit
         */
        config: function (e) {
            e.preventDefault();


            if ((!vm.cube.t && !vm.steps) || !vm.cube.n || !vm.cube.m) {
                return alert("Por favor completa el formulario!");
            }


            vm.comandos = [];
            vm.newCommand = "";
            vm.actions = 0;

            $.post("/", {n: vm.cube.n, m: vm.cube.m}).done(function (response) {
                $('#myModal').modal('hide');
            }).fail(function (data) {

                processErrorMessages(data);
            });


        },
        /**
         * Envia un comando al servidor y procesa su respuesta
         * @param e Evento que lo invoco
         */
        enviarComando: function (e) {
            e.preventDefault();
            // Este metodo enviara la informacion al servidor cuando este se haya implementado...

            var comandos = vm.newCommand.split(" ");

            switch (comandos[0].toUpperCase()) {
                case "UPDATE":
                    if (comandos.length !== 5) {
                        return alert("Comando UPDATE mal formado");
                    }

                    $.post("/update", {
                        x: comandos[1],
                        y: comandos[2],
                        z: comandos[3],
                        value: comandos[4]
                    }).done(function (response) {
                        vm.comandos.push({text: vm.newCommand, date: new Date(), response: "OK"});
                        vm.newCommand = "";
                        updateActions();
                    }).fail(function (data) {
                        processErrorMessages(data);
                    });
                    break;
                case "QUERY":

                    if (comandos.length !== 7) {
                        return alert("Comando QUERY mal formado");
                    }

                    $.post("/query", {
                        x1: comandos[1],
                        y1: comandos[2],
                        z1: comandos[3],
                        x2: comandos[4],
                        y2: comandos[5],
                        z2: comandos[6]
                    }).done(function (response) {
                        vm.comandos.push({text: vm.newCommand, date: new Date(), response: response.result});
                        vm.newCommand = "";
                        updateActions();
                    }).fail(function (data) {
                        processErrorMessages(data);
                    });
                    break;

                default:
                    return alert("El comando " + vm.newCommand + " no es valido");

                    break;
            }


        },
        resetCube: function (e) {
            e.preventDefault();
            $('#myModal').modal('show');

        }
    }
});