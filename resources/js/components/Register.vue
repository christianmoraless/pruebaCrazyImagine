<template>
    <div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h5 class="text-center">Register</h5>
                <form @submit.prevent="register">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Full Name</label>
                        <input type="text" class="form-control" v-model="fullname">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control" v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" v-model="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control">
                    </div>
                    <div class="">
                        <p class="text-center">already have an account ? <router-link to="login">login</router-link></p>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block ">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        name:'Register',
        data(){
            return{
                fullname:'',
                email:'',
                password:''
            }
        },
        methods:{
            register(){
                const params = {
                    name:this.fullname,
                    email :this.email,
                    password :this.password
                }
                console.log(params)
                axios.post('api/user/register',params).then(response => {
                    if(response.data.success === false) {
                        alert('Registro Fallido')
                    } else {
                        alert('Registro Exitoso')
                        this.$router.push({ path: 'login' })
                    }
                })
            }
        }
    }
</script>