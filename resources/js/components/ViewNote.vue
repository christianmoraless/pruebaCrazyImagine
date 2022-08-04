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
                    <button type="submit" class="btn btn-primary" @click="edit">Submit</button>
                </form>
            </div>
        </div>

        <h3 class="text-center">Add Label</h3>
        <div class="row mt-5">
             
        </div>
    </div>
</template>
<script>
export default{
    name:'ViewNote',
    data(){
        return{
            id:this.$route.params.id,
            note:[]
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
        }
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
    }
}
</script>