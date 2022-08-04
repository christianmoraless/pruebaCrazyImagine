<template>
    <div>
        <h3 class="text-center">View Note</h3>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <form>
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" v-model="note.title">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" v-model="note.description">
                    </div>
                    <button type="submit" class="btn btn-primary" @click="edit">Edit</button>
                </form>
            </div>
        </div>

        <h3 class="text-center">Add Label</h3>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="labels">
                    <div class="label d-flex justify-content-between align-items-center my-3 shadow py-3 px-4" v-for="(item,index) of labels" :key="index">
                        <div class="title">
                            <h6 class="m-0">{{item.title}}</h6>
                        </div> 
                        <div class="actions" >
                            <button class="btn btn-danger btn-sm" @click="deleteLabel(item)">Delete</button>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" v-model="label">
                    </div>
                    <button type="submit" class="btn btn-primary" @click="addLabel">Add Label</button>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    name:'ViewNote',
    data(){
        return{
            id:this.$route.params.id,
            note:[],
            labels:[],
            label:'',
        }
    },
    methods:{
        edit(e){
            e.preventDefault();
            const params = {
                title :this.note.title,
                description :this.note.description,
            }
            axios.put('http://localhost:8000/api/notes/update/'+this.note.id,params,{
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+localStorage.getItem('token')
                },
            }).then(response => {
                this.$router.push({ path: '../dashboard' });
            })
        },
        addLabel(e){
            e.preventDefault();
            const params = {
                id:this.note.id,
                title :this.label,
            }
            console.log(params)
            axios.post('http://localhost:8000/api/label/store',params,{
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+localStorage.getItem('token')
                },
            }).then(response => {
                // console.log(response);
                // this.label='';
                window.location.reload();
            })
        },
        deleteLabel(item){
            axios.delete(`http://localhost:8000/api/label/delete/${item.id}`,{
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+localStorage.getItem('token')
                },
            }).then(response => {
                alert('Successful removal')
                window.location.reload();
            })
        },
    },
    created(){ 
        axios.get('http://localhost:8000/api/notes/show/'+this.id,{
         headers: {
             'Content-Type': 'application/json',
             'Authorization': 'Bearer '+localStorage.getItem('token')
         },
        }).then(response => {
            this.note = response.data
        })

        axios.get('http://localhost:8000/api/label/show/'+this.id,{
         headers: {
             'Content-Type': 'application/json',
             'Authorization': 'Bearer '+localStorage.getItem('token')
         },
        }).then(response => {
            this.labels = response.data
        })
    }
}
</script>