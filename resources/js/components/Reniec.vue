<template>
    <div class="col-sm-12">
        <div class="form-group">
            <span class="col-sm-4">CONFERENCIA </span>
            <select class="custom-select col-sm-8">
                <option selected>Seleccionar</option>
                    <option v-for="row in conferencias">
                        <span
                             v-for="data in row" 
                            value="id_empresa" 
                            v-on:click="id_empresa=data.id_conferencia">
                            {{data}}
                        </span>
                        
                    </option>
            </select>
            <a href="exportar" class="btn btn-sm btn-success" >Exportar</a>
        </div>
        <form class="form-inline">
            <span>DNI : </span>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" id="dni" name="dni" v-model="dni" v-on:click="dni_reniec=false; dni_existe=false" maxlength="8">
                <span v-if="dni_reniec" class="text-danger">Error al Consultar el DNI</span>
                <span v-if="dni_existe" class="text-danger">Ya esta Registrado</span>

            </div>
            <button type='button' class="btn btn-sm btn-success" v-on:click ="valida_dni()">Consultar Raniec</button>
        </form>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                dni: '',
                dni_reniec:false,
                conferencias: [],
                persona: [],
                dni_existe: false
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.conferencias_show();
        },
        methods: {
            conferencias_show(){
                axios.get('/consulta_conferencias')
                .then( response => {
                    console.log(response.data);
                    this.conferencias=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                    console.log('error');
                });
            },
            valida_dni(){
                axios.get('/virifica_dni',{
                    params: {
                        dni: this.dni,
                        id_conferencia: this.conferencias[0]['id_conferencia']
                    }
                })
                .then( response => {
                    if(response.data.estado==true){
                        this.dni_existe=true;
                    }else{
                        this.dni_existe=false;
                        this.consultadni();
                    }

                })
                .catch(function (error) {
                    console.log(error);
                    console.log('error');
                });
            },
            consultadni(){
                var url="https://dniruc.apisperu.com/api/v1/dni/"
                var token="?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Im1pbHF1aWFzZXQ5MUBob3RtYWlsLmNvbSJ9.xqK2zwbP6DKj2ewD-SYDQ6fdnbbhHOuACVmV5ZdKvss"
                console.log(url+this.dni+token)
                axios.get(url+this.dni+token)
                .then( response => {
                    //document.getElementById('numdni').value=response.data['dni'];
                    //document.getElementById('paterno').value=response.data['apellidos'];
                    //document.getElementById('materno').value=response.data['apellidoMaterno'];
                    //document.getElementById('nombres').value=response.data['nombres'];
                    this.persona=response.data;
                })
                .catch(function (error) {
                    this.dni_reniec=true;
                    console.log(error);
                    console.log('error');
                });
                if (this.persona['nombres']=='') {
                    this.persona['apellidos']=this.persona['apellidoPaterno']+' '+this.persona['apellidoMaterno']
                    this.$emit('newpersona', this.persona);
                    this.$emit('error_dni', {'error':0});
                }else{
                    
                    this.consultadni2();
                }
                console.log('ingresa a otra funcin interna')
                console.log(this.persona['nombres'])
            },
            consultadni2(){
                axios.get("/consulta_dni", {
                    params: {
                        dni: this.dni,
                    }
                })
                .then( response => {
                    //document.getElementById('numdni').value=response.data['dni'];
                    //document.getElementById('paterno').value=response.data['apellidos'];
                    //document.getElementById('materno').value=response.data['apellidoMaterno'];
                    //document.getElementById('nombres').value=response.data['nombres'];
                    if (response.data['estado']) {
                        this.persona=response.data;
                        this.$emit('newpersona', this.persona);
                        this.$emit('error_dni', {'error':0});
                    }else{
                        this.$emit('error_dni', {'error':1});
                        this.dni_reniec=true;
                    }

                })
                .catch(function (error) {
                    this.dni_reniec=true;
                    console.log(error);
                    console.log('error');
                });
            }
        }
    }
</script>
