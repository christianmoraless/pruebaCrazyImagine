<template>
    <div>
        <h3 class="text-center">Notes Deleted</h3>
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center mt-3 shadow " v-for="(item,index) of notes" :key="index">
                        <h5>{{item.title}} {{item.id}}</h5>
                        <p class="m-0">{{item.description}}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    name:'TrashNotes',
    data(){
        return{
            notes:[]
        }
    },
    created(){
        axios.get('http://localhost:8000/api/notes/archived',{
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