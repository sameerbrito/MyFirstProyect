<template lang="">
<div class="container edit">
    <h1>Editar</h1>
    <div class="abs-center">
        <form class="outline-form" action="" method="POST" enctype="multipart/form-data" @submit.prevent="editStudent">
            <div class="row mb-4">
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="Nombre">Nombre</label>
                        <input type="text" name="name" id="" value="" class="form-control" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label class="form-label" for="Apellido">Apellido</label>
                        <input type="text" name="last_name" id="" value="" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="btn-send"><button type="submit" class="btn btn-primary btn-block mb-4"><i class="bi bi-download"></i> Guardar</button></div>
        </form>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            id: this.id,
            students: [],
        }
    },
    methods: {
        getStudents() {
            axios.get('get-all-students')
                .then(response => {
                    this.students = response.data
                    console.log(this.students)
                    console.log(response)
                })
                .catch(error => {
                    console.error(error);
                })
        },
        // editStudent() {
        //     axios.put("/crud", student)
        //         .then(response => {
        //             console.log(response)
        //             location.href = '/crud';
        //         })
        //         .catch(error => {
        //             console.error(error);
        //         })
        // }
    },
}
</script>

<style lang="">

</style>
