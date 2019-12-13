<template>
    <div>
        <reniec @newpersona="newpersona" @error_dni="error_dni"></reniec> 
        <registro :persona="persona" :dni_false="dni_false" @asistente="asistente"></registro>
        <tablaregistro :id_asistente="id_asistente"></tablaregistro>
    </div>
</template>

<script>
    export default {
        
        data() {
            return {
                persona: [],
                id_asistente: '',
                dni_false: 0
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newpersona(newpersona) {
                this.persona = newpersona;
                console.log('inicio principal');
                console.log(this.persona);
                console.log('fin' + this.persona['dni']);
            },
            error_dni(error_dni){
                console.log(error_dni.error)
                this.dni_false=error_dni.error
            },
            asistente(asistente){
                console.log(asistente);
                this.id_asistente=asistente
            }
        }
    }
</script>
