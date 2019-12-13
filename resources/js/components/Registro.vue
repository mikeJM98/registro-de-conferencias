<template>
    <div class="col-sm-12">
        <h2 class="text-uppercase">Datos de registro</h2>
        <form v-on:submit.prevent="registra_asistentes()">
            
            <div class="form-row text-center mt-3" v-if="ingresar_libre">
                <div class="col" >
                    <input type="hidden" class="form-control" id="id_conferencia" name="id_conferencia" v-model="id_conferencia" require>
                    <label for="DNI">DNI </label>
                    <input type="text" class="form-control" id="numdni" name="numdni" v-model="persona.dni" placeholder="dni" require>
                </div>
                <div class="col">
                <label for="Apellido Paterno">Apellidos</label>
                <input type="text" class="form-control" id="paterno" name="paterno" v-model="persona.apellidos" value="" placeholder="apellido paterno"   require>
                </div>
                <div class="col">
                <label for="Nombres">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" v-model="persona.nombres" value="" placeholder="nombres"   require>
                </div>

            </div>
            <div class="form-row text-center mt-3" v-else>
                <div class="col">
                    <input type="hidden" class="form-control" id="id_conferencia" name="id_conferencia" v-model="id_conferencia" require>
                    <label for="DNI">NUM DNI</label>
                    <input type="text" class="form-control" id="numdni" name="numdni" v-model="persona.dni" placeholder="dni" require disabled>
                </div>
                <div class="col">
                <label for="Apellido Paterno">Apellidos</label>
                <input type="text" class="form-control" id="paterno" name="paterno" v-model="persona.apellidos" value="" placeholder="apellido paterno"   require disabled>
                </div>
                <div class="col">
                <label for="Nombres">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" v-model="persona.nombres" value="" placeholder="nombres"   require disabled>
                </div>
                <div class="col mt-4">
                    <label for="Ingresar"></label>
                    <button type='button'  v-if="dni_false" class="btn btn-sm btn-success" v-on:click ="ingresar_libre=true;persona.dni='';persona.apellidos='';persona.nombres=''">ingresar manualmentec</button>
                </div>
            </div>
            <div class="form-row text-center mt-3">
                <div class="col">
                <label for="correo">correo Electronico</label>
                <input type="email" class="form-control" id="correo" name="correo" v-model="correo" placeholder="oaa@gmail.com">
                </div>
                <div class="col">
                <label for="Celular">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" v-model="celular" placeholder="958746321" >
                </div>
                <div class="col">
                    <label for="Empresa">Empresa </label> 
                    <i class="col-sm-1 bg-success btn btn-success" data-toggle="modal" data-target="#nueva_enpresa">+</i>
                    <select class="col-sm-11 custom-select form-control">
                        <option selected>Seleccionar</option>
                        <option
                                v-for="data in empresas" 
                                value="id_empresa" 
                                v-on:click="id_empresa=data.id_empresa">
                            {{data.razon_social}}
                        </option>
                    </select>
                </div>
                <div class="col">
                <label for="Guardar">Accion</label>
                <button v-if="persona.dni" type='submit' class="form-control btn btn-sm btn-success" id="registrar" name="registrar">Registrar</button>
                <button v-if="!persona.dni" type='submit' class="form-control btn btn-sm btn-success" id="registrar" name="registrar" disabled >Registrar</button>
                </div>
            </div>
        </form>

        <!-- Modal -->
        <div class="col-sm-12">
            <div class="modal fade" id="nueva_enpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Nueva Empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="nueva_empresa()">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label" >RUC:</label>
                                <input type="text" class="form-control" id="ruc" v-model="ruc" v-on:click="error_n_e=false">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Razon Social:</label>
                                <input type="text" class="form-control" id="razon_social" v-model="razon_social" v-on:click="error_n_e=false">
                            </div>
                        </form>
                        <span class="text-danger" v-if="error_n_e">Error. Ingrese alguno de los datos</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" v-on:click="nueva_empresa()">Guardar</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
</template>

<script>
    export default {
        props:['persona','dni_false'],
        data(){
            return{
                ingresar_libre:false,

                id_conferencia: '1',
                correo: '',
                celular: '',
                id_empresa: '1',
                empresa: '',

                empresas: [],
                ruc: '',
                razon_social: '',
                error_n_e: false
            }
        },
        mounted() {
            this.empresas_search();
        },
        methods: {
            registra_asistentes(){
                const params={
                    id_conferencia: this.id_conferencia,
                    dni: this.persona['dni'],
                    nombre: this.persona['nombres'],
                    apellidos: this.persona['apellidos'],
                    correo: this.correo,
                    celular: this.celular,
                    id_empresa: this.id_empresa,
                    empresa: this.empresa
                }
                axios.post('/registrar_asistentes',params)
                .then(response=> {
                    this.$emit('asistente', response.data.id_asistente);
                    this.id_conferencia= '1';
                    this.persona['dni']= '';
                    this.persona['nombres']='';
                    this.persona['apellidos']='';
                    this.persona['apellidoMaterno']='';
                    this.correo= '';
                    this.celular= '';
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            autocompleted(){
                axios.get('/autocomplete', {
                    params: {
                        empresa: this.empresa
                    }
                })
                .then(respose=>{
                    console.log(respose.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            empresas_search(){
                axios.get('/empresas_search')
                .then(respose=>{
                    console.log(respose.data);
                    this.empresas=respose.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            nueva_empresa(){
                if (this.ruc=='' && this.razon_social=='') {
                    return this.error_n_e=true;
                }else{
                    if (this.razon_social=='') {
                        this.razon_social=this.ruc;
                    }else{
                        (this.razon_social).toUpperCase();
                    }
                    const params={
                        ruc: this.ruc,
                        razon_social: this.razon_social
                    }

                    axios.post('/nueva_empresa', params)
                    .then(response=>{
                        console.log(response.data);
                        this.empresas.push(response.data);
                        $('#nueva_enpresa').modal('hide')

                    })
                    .catch(error =>{
                        console.log(error);
                    });
                }
            }
            
            
        }
    }


</script>
