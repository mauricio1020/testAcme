<template>
    <div>
        <h1 class="text-center">Gestionar Conductores</h1>
        <hr/>
        <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-4">Nuevo</button>
        <!--modal-->
        <div class="modal" :class="{mostrar: modal}">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModal }}</h4>
                        <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label>Identificación</label>
                            <input v-model="driver.identification" type="text" class="form-control" id="plaque" placeholder="Identificación">
                        </div>

                        <div class="my-4">
                            <label>Primer Nombre</label>
                            <input v-model="driver.first_name" type="text" class="form-control" placeholder="Primer nombre">
                        </div>

                        <div class="my-4">
                            <label>Segundo Nombre</label>
                            <input v-model="driver.second_name" type="text" class="form-control" placeholder="Segundo nombre">
                        </div>

                        <div class="my-4">
                            <label>Apellidos</label>
                            <input v-model="driver.last_name" type="text" class="form-control" placeholder="Apellidos">
                        </div>

                        <div class="my-4">
                            <label>Dirección</label>
                            <input v-model="driver.direction" type="text" class="form-control" placeholder="Dirección">
                        </div>

                        <div class="my-4">
                            <label>Teléfono</label>
                            <input v-model="driver.phone" type="text" class="form-control" placeholder="Teléfono">
                        </div>

                        <div class="my-4">
                            <label>Ciudad</label>
                            <input v-model="driver.city" type="text" class="form-control" placeholder="Ciudad">
                        </div>

                        <div class="my-4">
                            <div class="form-group">
                                <label>Asignar vehiculo<span class="text-danger">*</span></label>
                                <select v-model="driver.vehicle_id" class="form-control">
                                    <option v-for="data in vehicles" :value="data.vehicle.id">
                                        {{ data.vehicle.text }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Identificacion</th>
                <th scope="col">Primer Nombre</th>
                <th scope="col">Segundo Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Ciudad</th>
                <th scope="col" colspan="2" class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="dr in drivers" :key="dr.id">
                <th scope="row">{{ dr.id }}</th>
                <td>{{ dr.identification }}</td>
                <td>{{ dr.first_name }}</td>
                <td>{{ dr.second_name}}</td>
                <td>{{ dr.last_name}}</td>
                <td>{{ dr.direction}}</td>
                <td>{{ dr.phone}}</td>
                <td>{{ dr.city}}</td>
                <td>
                    <button @click="modificar=true; abrirModal(dr);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="eliminar(dr.id)" class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    mounted() {
        this.loadVehicles();
    },
    data() {
        return {
            driver: {
                identification: 'yy455',
                first_name: 'azul',
                second_name: 'ford',
                last_name: 'ford',
                direction: 'ford',
                phone: 'ford',
                city: 'ford',
            },
            modificar: true,
            modal: 0,
            tituloModal: '',
            drivers: [],
            vehicles: [],

        };
    },
    methods: {
        loadVehicles() {
            axios.get("/getVehicles").then((response) => {
                this.vehicles = response.data;
            });
        },

        async listar() {
            const res = await axios.get('/conductores');
            this.drivers = res.data;
        },

        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Modificar Conductor";
                this.driver.identification = data.identification;
                this.driver.first_name = data.first_name;
                this.driver.second_name = data.second_name;
                this.driver.last_name = data.last_name;
                this.driver.direction = data.direction;
                this.driver.phone = data.phone;
                this.driver.city = data.city;
                this.driver.vehicle_id = data.vehicle_id;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Conductor";
                this.driver.identification = '';
                this.driver.first_name = '';
                this.driver.second_name = '';
                this.driver.last_name = '';
                this.driver.direction = '';
                this.driver.phone = '';
                this.driver.city = '';
                this.driver.vehicle_id = '';
            }
        },

        async eliminar(id) {
            const res = await axios.delete('/conductores/' + id);
            this.listar();
        },

        async guardar() {
            if (this.modificar) {
                const res = await axios.put('/conductores/' + this.id, this.driver);
            } else {
                const res = await axios.post('/conductores', this.driver);
            }
            this.cerrarModal();
            this.listar();
        },
        cerrarModal() {
            this.modal = 0;
        },
    },
    created() {
        this.listar();
    },
};
</script>
<style>
.mostrar {
    display: list-item;
    opacity: 1;
    background: rgba(75, 56, 143, 0.705);
}
</style>

