<template>
<div>

    <!-- Modal Create Student -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ student_id ? "Editar" : "Crear"}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" >Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                <strong>{{Session::get('success')}}</strong>
            </div>
        @endif -->
    <div class="contenedor">
        <div id=Left>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square"></i>
                Crear
            </button>
            <!-- <a href="/crud/create"><button class="btn btn-success"><i class="bi bi-plus-square"></i> Crear</button></a> -->
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
                        <form action="" method="" @submit.prevent="editStudent(student)">
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
        <Pagination :current="paginate.current_page" :total="paginate.total" :per-page="paginate.per_page" @page-changed="getStudents">
        </Pagination>
    </div>
</div>
</template>

<!-- Scripts -->

<script>
import Pagination from 'vue2-laravel-pagination'
export default {
    components: {
        Pagination
    },
    data() {

        return {
            action: true,
            student_id: "",
            search: '',
            students: [],
            paginate: {
                current_page: 0,
                total: 0,
                per_page: 0
            }
        }
    },
    methods: {
        saveTask() {
            alert(this.filter);
        },
        getStudents(page = 1) {
            axios.get('/get-all-students?page=' + page)
                .then(response => {
                    this.students = response.data.students.data
                    this.paginate.current_page = page
                    this.paginate.current_page = response.data.students.current_page
                    this.paginate.total = response.data.students.total
                    this.paginate.per_page = response.data.students.per_page
                    console.log(response.data.students)
                })
        },
        editStudent() {

        }
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
