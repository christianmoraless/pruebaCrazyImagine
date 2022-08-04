<template>
    <div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h5 class="text-center">Login</h5>
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control" v-model="email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" v-model="password">
                    </div>
                    <div class="">
                        <p class="text-center">don't have an account? <router-link to="register">sign up</router-link></p>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block ">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapState} from 'vuex';
    export default{
        name:'Login',
        data(){
            return{
                email:'',
                password:'',
                error:null
            }
        },
        methods:{
            ...mapState(['token','auth']),
            login(){
                const params = {
                    email :this.email,
                    password :this.password
                }
                axios.post('api/user/login',params).then(response => {
                    if(response.data.success === false){
                        this.error = response.data.message
                        alert('Login Fallido')
                    } else {
                       alert(`Login exitoso`)
                        localStorage.setItem('token', response.data.access_token);
                        this.$store.state.token=response.data.access_token;
                        this.$router.push({ path: 'dashboard' });
                    }
                })
            }
        }
    }
</script>