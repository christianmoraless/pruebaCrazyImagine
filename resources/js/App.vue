<template>
    <div>
        <nav class=" container navbar navbar-expand-lg navbar-light bg-light">
            <router-link to="/" class="navbar-brand">Navbar</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

           
            <div class="collapse navbar-collapse" id="navbarSupportedContent" v-if="!isLogged !== ''" >
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link to="/dashboard" class="nav-link">Dashboard</router-link>
                    </li>
                    <li class="nav-item">
                        <!-- <router-link to="/register" class="nav-link">Logout</router-link> -->
                        <a href="#" class="nav-link" @click="logout">Logout</a>
                    </li>
                </ul>
            </div>

             <div class="collapse navbar-collapse" id="navbarSupportedContent" v-else>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <router-link to="/login" class="nav-link">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link to="/register" class="nav-link">Register</router-link>
                    </li>
                </ul>
            </div>

        </nav>
        <div class="container py-5">
           <router-view></router-view>
        </div>
    </div>
</template>
<script>
    import {mapState} from 'vuex';
    export default{
        name:"App",
        data(){
            return{
                isLogged:localStorage.getItem('token')
            }
        },
        methods:{
            ...mapState(['auth']),
            logout(e){
                e.preventDefault();
                const token=localStorage.getItem('token')
                axios.post('/api/user/logout',token)
                    .then(response => {
                        localStorage.removeItem('token');
                        window.location.reload();
                })
            }
        }
    }
    
</script>