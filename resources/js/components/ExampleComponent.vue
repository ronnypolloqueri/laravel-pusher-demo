<template>
    <div class="container">

        <h4>Usuarios conectados: </h4>
        <ul class="text-center">
            <li v-for="user in users" :key="user.id">{{ user.name }}</li>
        </ul>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <input v-model="task" class="form-control" type="text">
                <button @click="addTask" class="btn btn-primary mt-2">Guardar</button>
            </div>
        </div>

        <div class="text-center">
            <p v-for="task in tasks" :key="task">{{ task }}</p>
        </div>
    </div>
</template>

<script>

    import axios from 'axios'

    export default {
        data() {
            return {
                task: '',
                tasks: [],
                users: []
            }
        },

        props: ["room"],

        created() {
            this.fillTask();
            console.log("created");

            // window.Echo.channel('canal')
            //     .listen('EventSocket', (e) => {
            //         this.tasks.push(e.task.name);
            //     })


            window.Echo.join('room.' + this.room)
                .here((users) => {
                    this.users = users;
                    console.log(users);
                })                    
                .joining((user) => {
                    this.users.push(user)
                    console.log("Se unió a la sala")
                    console.log(user);
                })
                .leaving((user) => {
                    this.users.splice(this.users.indexOf(user), 1);
                    console.log("Abandonó la sala")
                    console.log(user);
                })
        },

        methods: {
            addTask: function() {
                axios.post('/task', { name: this.task })
                    .then(response => {
                        this.tasks.push(response.data.name);
                        this.task = '';
                        console.log("response post task");
                        console.log(response);
                    })
            },

            fillTask: function() {
                this.tasks = [];

                axios.get('/tasks')
                    .then(response => {
                        this.tasks = response.data;
                        console.log("response post taskssss");
                        console.log(response);
                    })
                    .catch(e => {
                        console.log(e);
                    })
            }
        },
        mounted() {
            console.log('ExampleComponent mounted.')
        }
    }
</script>
