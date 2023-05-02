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
                                    <input class="form-control" type="text" v-model="input_student.name">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="Apellido">Apellido</label>
                                    <input class="form-control" type="text" v-model="input_student.last_name">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="Telefono">Telefono</label>
                                    <input class="form-control" type="phone">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label" for="Birthdate">Fecha de Nacimiento</label>
                                    <input class="form-control" type="date">
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="beforeClose">Close</button>

                        <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista de estudiantes -->
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
                    <th></th>
                    <th style="text-align: center; width: 100px;">
                        <i class="bi bi-pencil-square"></i>
                    </th>
                    <th style="text-align: center; width: 100px;">
                        <div class="d-flex justify-content-center">
                            <div class="form-check form-switch">
                                <input style="margin-bottom: 5px;" @click="massiveDelete()" class="form-check-input" type="checkbox" id="massiveDeleteCheckBox">
                            </div>
                            <button class="btn btn-outline-dark deleteButton disabled" v-if="!mass_delete"><i class="bi bi-x-lg"></i></button>
                            <button class="btn btn-outline-danger deleteButton" @click="confirmMessage()" v-else><i class="bi bi-x-lg"></i></button>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="student,i in filteredStudents" :key="i">
                    <td>{{ student.id }}</td>
                    <td>{{ student.name }}</td>
                    <td>{{ student.last_name }}</td>
                    <td style="width: 50px;"><button type="button" class="btn btn-secondary" @click="mapStudent()"><i class="bi bi-person-vcard-fill"></i></button></td>
                    <td class="actions">
                        <button type="submit" class="btn btn-primary" @click="showModal(student.id), selectStudent(student)"><i class="bi bi-pencil-square"></i> Editar</button>
                    </td>
                    <td class="actions" v-if="!mass_delete">
                        <button type="submit" class="btn btn-outline-danger" @click="confirmMessage(student.id)"><i class="bi bi-trash"></i> Borrar</button>
                    </td>
                    <td class="actions" v-else>
                        <div>
                            <input @click="deleteSelectedStudents(student)" style="
                            width: 25px; 
                            height: 25px;" class="form-check-input" type="checkbox" :id="`check${i}`" :checked="unselectCheck(student.id)" />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="justify-content-end">
            <Pagination :current="paginate.current_page" :total="paginate.total" :per-page="paginate.per_page" @page-changed="getStudents"></Pagination>
        </div>
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
            checked: false,
            checkedStudents: [],
            mass_delete: false,
            full_name: [],
            time: '',
            myModal: null,
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
                    if (response.data.success) {
                        console.log(response.data.success)
                        Swal.fire({
                            icon: 'success',
                            title: response.data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.cleanInputs()
                        this.myModal.hide()
                        this.getStudents(this.paginate.current_page)
                    } else {
                        console.log(response.data.error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.data.error,
                        })
                    }
                })
        },
        editStudent() {
            axios
                .put(`/crud/${this.student_id}`, this.input_student)
                .then(response => {
                    if (response.data.success) {
                        // console.log(response.data.success)
                        Swal.fire({
                            icon: 'success',
                            title: response.data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.cleanInputs()
                        this.myModal.hide()
                        this.getStudents(this.paginate.current_page)
                    } else {
                        // console.log(response.data.error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.data.error,
                        })
                    }
                })
        },
        deleteStudent(student_id) {
            axios.delete(`/crud/${student_id}`)
                .then(response => {
                    console.log(response)
                    this.cleanInputs()
                    this.getStudents(this.paginate.current_page)
                })
                .catch(error => {
                    console.error(error);
                    this.getStudents(this.paginate.current_page)
                })
        },
        selectStudent(student) {
            this.input_student = {
                ...student
            }
        },
        massiveDelete() {
            this.checkedStudents = []
            this.mass_delete = document.getElementById('massiveDeleteCheckBox').checked
        },
        deleteSelectedStudents(student) {
            this.checkedStudents.indexOf(student.id) == -1 ?
                this.checkedStudents.push(student.id) :
                this.checkedStudents.splice(this.checkedStudents.indexOf(student.id), 1)
        },
        confirmMessage(student_id) {
            if (this.mass_delete == true) {
                if (!this.checkedStudents.length) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No tienes estudiantes seleccionado!',
                    })
                } else {
                    Swal.fire({
                        title: 'Estas seguro?',
                        text: "Los estudiantes se eliminaran permanentemente",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.deleteAllChecked()
                            this.checkedStudents = []
                        }
                    })
                }
            } else {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "El estudiantes se eliminaran permanentemente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.deleteStudent(student_id)
                    }
                })
            }
        },
        unselectCheck(id) {
            if (this.checkedStudents.includes(id)) {
                return true
            } else {
                return false
            }
        },
        deleteAllChecked() {
            axios.delete('/delete-selected-students/', {
                    params: this.checkedStudents
                })
                .then(response => {
                    if (response.data.success) {
                        console.log(response.data.success)
                        Swal.fire({
                            icon: 'success',
                            title: response.data.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.cleanInputs()
                        this.getStudents()
                    } else {
                        console.log(response.data.error)
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.data.error,
                        })
                        this.getStudents()
                    }
                })
        },
        mapStudent() {
            this.full_name = this.students.map((stu) => {
                return `${stu.name} ${stu.last_name}`
            });
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
        clock() {
            setInterval(() => {
                this.time = moment().format('HH:mm:ss')
            }, 1000)

        },
    },
    computed: {
        filteredStudents() {
            return this.students.filter((el) =>
                el.name.toLowerCase().includes(this.search.toLowerCase()) ||
                el.last_name.toLowerCase().includes(this.search.toLowerCase()));
        },
    },
    watch: {
        checkedStudents(newValue, oldValue) {}
    },
    mounted() {
        this.clock()
        this.getStudents()
    },
}
</script>

<!-- Style -->
<style>
.form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}
</style>
