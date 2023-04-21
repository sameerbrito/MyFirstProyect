<template lang="">
<div class="card w-50 start-50 translate-middle-x">
    <div class="card-header text-center">
        <h2>Example Component</h2>
    </div>
    <div class="d-flex">
        <div class="col">
            <div class="">
                <div class="mt-3">
                    <input type="text" class="form-control position-relative w-50 text-center start-50 translate-middle-x" v-model="message">
                </div>
                <div class="card-body text-center mt-1">
                    <h1>{{message}}</h1>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="">
                <div>
                    <div class="d-flex mt-3">
                        <input type="number" class="form-control text-center me-2 ms-2" v-model="sum.a">
                        <input type="number" class="form-control text-center me-2 ms-2" v-model="sum.b">
                    </div>
                    <button class="btn btn-primary position-relative w-25 text-center start-50 translate-middle-x mt-2" type="input" @click="result(sum)">Sumar</button>
                </div>
                <div class="card-body text-center">
                    <h2>{{ sum.total }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
    export default {
        data() {
            return {
                message: 'Hola mundo!',
                sum: {
                    a: 0,
                    b: 0,
                    total: 0,
                }
            }
        },
        methods: {
            result(sum) {
                sum.total = (parseInt(sum.a) + parseInt(sum.b));
            }
        },
        // computed: {
        //     totalSum(){
        //         return (parseInt(this.sum.a) + parseInt(this.sum.b));
        //     }
        // },
        mounted() {
        }
    }
</script>

<style lang="css">

</style>

<!-- <template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div>
                        <input type="number" class="form-control" v-model="sum.a">
                        <input type="number" class="form-control" v-model="sum.b">
                        <button class="" type="input" @click="result(sum)">Sumar</button>
                    </div>
                    <div class="card-body">
                        {{ sum.total }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                sum:{
                    a:0,
                    b:0,
                    total:0,
                }
            }
        },
        methods:{
            result(sum){
                sum.total = (parseInt(sum.a) + parseInt(sum.b));
            }
        },
        // computed: {
        //     totalSum(){
        //         return (parseInt(this.sum.a) + parseInt(this.sum.b));
        //     }
        // },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script> -->
