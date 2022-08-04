<template>
    <div>
        <div>
            <h3 class="text-center">Notes App</h3>
            <div class="row mt-4 ">
                <!-- <div class="col-md-8 mx-auto">
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Note">
                            <button type="" class="btn btn-info text-white">Search Note</button>
                        </div>
                    </form>
                </div> -->
            </div>
            <div class="row mt-5">
                <div class="col-md-8 mx-auto">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <button class="btn btn-primary shadow" data-toggle="modal" data-target="#addNote">Add note</button>
                        <router-link class="btn btn-primary shadow" to="/trash">Trash</router-link>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center mt-3 shadow " v-for="(item,index) of notes" :key="index">
                            <div class="">
                                <h5>{{item.title}}</h5>
                                <p class="m-0">{{item.description}}</p>
                            </div>
                            <div class="options">
                                <router-link class="btn btn-success btn-sm" :to="'viewNote/'+item.id">View note</router-link>
                                <button type="" class="btn btn-danger btn-sm " @click="deleteNote(item,index)">Delete</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>





        <!-- Modal add-->
        <div class="modal fade" id="addNote" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new Note</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title Note</label>
                            <input type="text" class="form-control" v-model="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" class="form-control" v-model="description">
                        </div>
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="registerNote">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default{
        name:'Dashboard',
        data(){
            return{
                title:'',
                description:'',
                notes:[],
            }
        },
        methods:{
            registerNote(e){
                e.preventDefault();
                const params = {
                    title :this.title,
                    description :this.description,
                }
                axios.post('api/notes/store',params,{
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer '+localStorage.getItem('token')
                    },
                }).then(response => {
                    console.log(response)
                })
                this.title='';
                this.description='';
                window.location.reload();
            },

            deleteNote(item,index){
                axios.delete(`api/notes/delete/${item.id}`,{
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer '+localStorage.getItem('token')
                    },
                }).then(response => {
                    window.location.reload();
                })
            }
        },
        created(){
            axios.get('http://localhost:8000/api/notes/index',{
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+localStorage.getItem('token')
                },
            }).then(response => {
                console.log(response)
                this.notes = response.data;
            })
        }
    }
</script>