<template>
    <div>
        <h1 class="text-center">Gestionar Vehiculos</h1>
        <hr/>
        <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary my-">Nuevo</button>
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
                            <label for="plaque">Placa</label>
                            <input v-model="vehiculo.plaque" type="text" class="form-control" id="plaque"
                                   placeholder="Placa del vehiculo">
                            <span class="text-danger" v-if="errores.plaque">{{ errores.plaque[0] }}</span>
                        </div>

                        <div class="my-4">
                            <label for="color">Color</label>
                            <input v-model="vehiculo.color" type="text" class="form-control" id="color"
                                   placeholder="Color del vehiculo">
                            <span class="text-danger" v-if="errores.color">{{ errores.color[0] }}</span>
                        </div>

                        <div class="my-4">
                            <label for="mark">Marca</label>
                            <input v-model="vehiculo.mark" type="text" class="form-control" id="mark"
                                   placeholder="Marca del vehiculo">
                            <span class="text-danger" v-if="errores.mark">{{ errores.mark[0] }}</span>
                        </div>

                        <div class="my-4">
                            <label>Tipo</label>
                            <select v-model="vehiculo.type" class="form-control" aria-label="Default select example">
                                <option v-for="typeVehicule in typeVehicules" v-bind:value="typeVehicule.value">
                                    {{ typeVehicule.text }}
                                </option>
                            </select>
                            <span class="text-danger" v-if="errores.type">{{ errores.type[0] }}</span>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                        <button @click="guardar();" type="button" class="btn btn-success" data-dismiss="modal">Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!--modal detalle-->
        <div class="modal" :class="{mostrar: modal2}">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">{{ tituloModalDetalle }}</h4>
                        <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">
                            &times;
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="my-4">
                            <label>Placa</label>
                            <input v-model="detail.plaque" type="text" class="form-control"
                                   placeholder="Placa del vehiculo">
                        </div>

                        <div class="my-4">
                            <label>Marca</label>
                            <input v-model="detail.mark" type="text" class="form-control"
                                   placeholder="Marca del vehiculo">
                        </div>

                        <div class="my-4">
                            <label>Nombre del conductor</label>
                            <input v-model="detail.first_name_driver" type="text" class="form-control"
                                   placeholder="Nombre del conductor">
                        </div>

                        <div class="my-4">
                            <label>Nombre del propietario</label>
                            <input v-model="detail.first_name_owner" type="text" class="form-control"
                                   placeholder="Nombre del propietario">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button @click="cerrarModal();" type="button" class="btn btn-secondary" data-dismiss="modal">
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">plaque</th>
                <th scope="col">color</th>
                <th scope="col">mark</th>
                <th scope="col">type</th>
                <th scope="col" colspan="3" class="text-center">Accion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="veh in vehiculos.data" :key="veh.id">
                <th scope="row">{{ veh.id }}</th>
                <td>{{ veh.plaque }}</td>
                <td>{{ veh.color }}</td>
                <td>{{ veh.mark }}</td>
                <td>{{ veh.type }}</td>
                <td>
                    <button @click="detalle=true; abrirDetalle(veh.id);" class="btn btn-info">Ver Detalle</button>
                </td>
                <td>
                    <button @click="modificar=true; abrirModal(veh);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="eliminar(veh.id)" class="btn btn-danger">Eliminar</button>
                </td>
            </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-3 md-3 text-right text-primary">
                {{ vehiculos.from }} - {{ vehiculos.to }} /total: {{ vehiculos.total }}
            </div>
            <div class="col-2 md-2">
                <select class="form-control" v-model="pagination.per_page" @change="listar();">
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="8">8</option>
                </select>
            </div>
            <div class="col-7 md-7">
                <nav>
                    <ul class="pagination">
                        <li class="page-item" :class="{disabled:pagination.page==1}"><a href="#" class="page-link" @click="pagination.page=1; listar();">&laquo;</a></li>
                        <li class="page-item" :class="{disabled:pagination.page==1}"><a href="#" class="page-link" @click="pagination.page--; listar();">&lt;</a></li>
                        <li class="page-item" v-for="n in paginas" :key="n" :class="{active:pagination.page==n}"><a href="#" class="page-link" @click="pagination.page=n; listar();">{{ n }}</a></li>
                        <li class="page-item" :class="{disabled:pagination.page==vehiculos.last_page}"><a href="#" class="page-link" @click="pagination.page++; listar();">&gt;</a></li>
                        <li class="page-item" :class="{disabled:pagination.page==vehiculos.last_page}"><a href="#" class="page-link" @click="pagination.page=vehiculos.last_page; listar();">&laquo;</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.loadTypeVehicules();
    },
    data() {
        return {
            vehiculo: {
                plaque: 'yy455',
                color: 'azul',
                mark: 'ford'
            },
            detail: {
                plaque: 'yy455',
                mark: 'azul',
                first_name_driver: 'ford',
                first_name_owner: 'ford'
            },
            modificar: true,
            detalle: true,
            modal: 0,
            modal2: 0,
            tituloModal: '',
            tituloModalDetalle: '',
            vehiculos: [],
            typeVehicules: [],
            drivers: [],
            owners: [],
            errores: {},
            pagination: {
                page: 1,
                per_page: 5,
            },
            paginas:[],
        };
    },
    methods: {
        loadTypeVehicules() {
            this.typeVehicules = [
                {text: "Particular", value: "Particular"},
                {text: "Pùblico", value: "Pùblico"},
            ];
        },
        async listar() {
            const res = await axios.get('/vehiculos', {params: this.pagination});
            this.vehiculos = res.data;
            this.listarPaginas();
        },

        listarPaginas(){
           const n=2
           let arrayN=[]
           let ini = this.pagination.page -2
            if(ini<1){
                ini=1
            }
            let fin = this.pagination.page +2
            if(fin>this.vehiculos.last_page){
               fin=this.vehiculos.last_page
            }
            for(let i=ini; i<=fin; i++){
                arrayN.push(i)
            }
            this.paginas = arrayN
        },
        async eliminar(id) {
            const res = await axios.delete('/vehiculos/' + id);
            this.listar();
        },

        abrirDetalle(id) {
            this.modal2 = 1;
            axios.get('/detalle-vehiculo/' + id).then((response) => {
                this.tituloModalDetalle = "Detalle Vehiculo";
                console.log(response)
                this.detail.plaque = response.data.plaque;
                this.detail.mark = response.data.mark;
                this.detail.first_name_driver = response.data.drivers[0].first_name;
                this.detail.first_name_owner = response.data.owner.first_name;
            });
        },
        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Modificar Vehiculo";
                this.vehiculo.plaque = data.plaque;
                this.vehiculo.color = data.color;
                this.vehiculo.mark = data.mark;
                this.vehiculo.type = data.type;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Vehiculo";
                this.vehiculo.plaque = '';
                this.vehiculo.color = '';
                this.vehiculo.mark = '';
                this.vehiculo.type = '';
            }
        },

        async guardar() {
            try {
                if (this.modificar) {
                    const res = await axios.put('/vehiculos/' + this.id, this.vehiculo);
                } else {
                    const res = await axios.post('/vehiculos', this.vehiculo);
                }
                this.cerrarModal();
                this.listar();
            } catch (error) {
                if (error.response.data) {
                    this.errores = error.response.data.errors
                }
            }
        },

        cerrarModal() {
            this.modal = 0;
            this.modal2 = 0;
            this.errores = {}
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






