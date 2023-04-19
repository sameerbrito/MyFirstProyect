<template>
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
</script>