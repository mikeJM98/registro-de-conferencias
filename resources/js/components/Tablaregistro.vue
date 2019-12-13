<template>
                <div class="col-sm-12 mt-5">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">DNI</th>
                                <th scope="col">apellidos</th>
                                <th scope="col">nombres</th>
                                <th scope="col">correo</th>
                                <th scope="col">telefono</th>
                                <th scope="col">empresa</th>
                                <div v-if="id_asistente" >
                                    <button type='submit' class="form-control btn btn-sm btn-success" v-on:click="consulta_asistente(id_asistente)">Actualizar{{id_asistente}}</button>
                                </div>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(asistente, index) in asistentes">
                                    <th scope='row' >{{asistentes.length-index}}</th>
                                    <td v-for="valor in asistente"> {{valor}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
</template>

<script>
    export default {
        props:['id_asistente'],
        data(){
            return{
                dni: '',
                asistentes: [],
            }
        },
        mounted() {
            this.consulta_asistentes();
        },
        methods: {
            consulta_asistentes(){
                axios.get('/consulta_asistentes')
                    .then(response=>{
                        this.asistentes=response.data;
                    })
                    .catch(error=>{
                        console.log(error);
                    });
                console.log(this.asistentes);
            },

            consulta_asistente(id_asistente){
                axios.get('/consulta_asistente', {
                    params: {
                        id_asistente: id_asistente
                    }
                })
                .then(response=>{
                    console.log(response);
                    this.asistentes.unshift(response.data);
                })
                .catch(function (error) {
                    console.log(error);
                });
                this.id_asistente=''
            }
        }
    }
</script>
