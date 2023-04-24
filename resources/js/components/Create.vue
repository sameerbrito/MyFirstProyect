<template lang="">
<div class="container create">
    <h1>Crear</h1>
    <div class="abs-center">
        <form class="outline-form" action="" method="POST" enctype="multipart/form-data" @submit.prevent="saveStudent(student)">
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="Nombre">Nombre</label>
                        <input class="form-control" type="text" name="name" id="" value="" v-model="student.name">
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="Apellido">Apellido</label>
                        <input class="form-control" type="text" name="last_name" id="" value="" v-model="student.last_name">
                    </div>
                </div>
            </div>
            <!-- @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Favor llenar todos los campos</strong>
                </div>
            @endif -->
            <div class="btn-send"><button class="btn btn-success btn-block mb-4"><i class="bi bi-download"></i> Guardar</button></div>
        </form>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            student: {
                name: '',
                last_name: ''
            }
        }
    },
    methods: {
        saveStudent(student) {
            axios.post('/crud', student)
                .then(response => {
                    console.log(response)
                    location.href = '/crud';
                })
                .catch(error => {
                    console.log(error.response)
                })

        }
    },
}
</script>

<style lang="">

</style>
