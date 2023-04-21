<template>
<div>
    <!-- @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{Session::get('success')}}</strong>
            </div>
        @endif -->
    <div class="contenedor">
        <div id=Left>
            <a href=""><button class="btn btn-success"><i class="bi bi-plus-square"></i> Crear</button></a>
        </div>
        <div id=Right>
            <form action="" method="GET" class="d-flex" @submit.prevent="saveTask()">
                <input class="form-control me-2" name="Search" type="text" placeholder="Buscar" aria-label="Search" v-model="search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <table class="table table-hover">
            <thead>
                <tr class="text">
                    <th class="num">#</th>
                    <th class="nem">Nombre</th>
                    <th class="nem">Apellido</th>
                    <th style="text-align: center" colspan="2">Acciones</th>
                </tr>
            </thead>
            <!-- @foreach ($test as $person) -->
            <tbody>
                <tr v-for="student,i in filteredStudents" :key="i">
                    <td>{{ student.id }}</td>
                    <td>{{ student.name }}</td>
                    <td>{{ student.last_name }}</td>
                    <td class="actions">
                        <form action="" method="">
                            <!-- @csrf 
                                @method('PUT') -->
                            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Editar</button>
                        </form>
                    </td>
                    <td class="actions">
                        <form action="" method="">
                            <!-- @csrf 
                                @method('DELETE') -->
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Quieres ELIMINAR los datos del estudiante?')"><i class="bi bi-trash"></i> Borrar</button>
                        </form>
                    </td>
                </tr>
            </tbody>
            <!-- @endforeach -->
        </table>
    </div>
</div>
</template>

<!-- Scripts -->

<script>
export default {
    data() {
        return {
            search: '',
            students: [],
        }
    },
    methods: {
        saveTask() {
            alert(this.filter);
        },
        getStudents() {
            axios.get('get-all-students')
                .then(response => {
                    this.students = response.data.students
                    console.log(response.data.students)
                })
        },
    },
    computed: {
        filteredStudents() {
            return this.students.filter((el) =>
                el.name.toLowerCase().includes(this.search.toLowerCase()) ||
                el.last_name.toLowerCase().includes(this.search.toLowerCase()));
        },
    },
    mounted() {
        this.getStudents()
    },
}
</script>

<!-- Style -->

<style>

</style>
