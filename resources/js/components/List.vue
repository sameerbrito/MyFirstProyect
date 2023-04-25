<template>
<div>
    <!-- Modal Create Student -->
    <div class="modal fade" id="theModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ student_id ? "Editar" : "Crear" }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="beforeClose"></button>
                </div>
                <form @submit.prevent="student_id ? editStudent() : saveStudent()">
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="Nombre">Nombre</label>
                                    <input class="form-control" type="text" required v-model="input_student.name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="Apellido">Apellido</label>
                                    <input class="form-control" type="text" required v-model="input_student.last_name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-danger mh-50" role="alert" v-if="error != 0">
                            Debes de completar todos los campos!
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="beforeClose">Close</button>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="contenedor">
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-success" @click="showModal()"><i class="bi bi-plus-square"></i>
                Crear
            </button>
            <div id="clock" class="btn btn-dark"><i class="bi bi-clock"></i> {{ time }}</div>
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
                            <button type="submit" class="btn btn-primary" @click="showModal(student.id), selectStudent(student)"><i class="bi bi-pencil-square"></i> Editar</button>
                        </td>
                        <td class="actions">
                            <button type="submit" class="btn btn-outline-danger" @click="deleteStudent(student.id)" onclick="alert('deseas eliminarlo al estudiante')"><i class="bi bi-trash"></i> Borrar</button>
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
            modal_title: "",
            time: '',
            myModal: null,
            error: 0,
            action: true,
            student_id: '',
            search: '',
            students: [],
            input_student: {
                name: '',
                last_name: ''
            },
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
            axios
                .get('/get-all-students?page=' + page)
                .then(response => {
                    this.students = response.data.students.data
                    this.paginate.current_page = page
                    this.paginate.total = response.data.students.total
                    this.paginate.per_page = response.data.students.per_page
                })
        },
        saveStudent() {
            axios
                .post('/crud', this.input_student)
                .then(response => {
                    console.log(response)
                    this.cleanInputs()
                    this.myModal.hide()
                    this.getStudents(1)
                })
                .catch(error => {
                    console.log(error.response)
                    this.error = error.response.status
                    setTimeout(() => {
                        this.error = 0
                    }, 3000);
                })
        },
        editStudent() {
            axios.put(`/crud/${this.student_id}`, this.input_student)
                .then(response => {
                    console.log(response)
                    this.cleanInputs()
                    this.myModal.hide()
                    this.getStudents(1)
                })
                .catch(error => {
                    console.log(error.response)
                    this.error = error.response.status
                    setTimeout(() => {
                        this.error = 0
                    }, 3000);
                })
        },
        deleteStudent(student_id) {
            axios.delete(`/crud/${student_id}`)
                .then(response => {
                    console.log(response)
                    this.cleanInputs()
                    this.getStudents(1)
                })
                .catch(error => {
                    console.error(error);
                    this.getStudents(1)
                })
        },
        selectStudent(student) {
            this.input_student = {
                ...student
            }
        },
        showModal(student_id) {
            this.student_id = student_id
            this.myModal = new bootstrap.Modal(document.getElementById('theModal'))
            this.myModal.show()
        },
        beforeClose() {
            this.cleanInputs()
        },
        cleanInputs() {
            this.input_student.name = ""
            this.input_student.last_name = ""
        },
        clock(){
            setInterval(()=>{
                this.time = moment().format('h:mm:ss a')
            }, 1000)

        }
    },
    computed: {
        filteredStudents() {
            return this.students.filter((el) =>
                el.name.toLowerCase().includes(this.search.toLowerCase()) ||
                el.last_name.toLowerCase().includes(this.search.toLowerCase()));
        },
    },
    watch: {
    },
    mounted() {
        this.clock()
        this.getStudents()
    },
}
</script>

<!-- Style -->

<style>

</style>
