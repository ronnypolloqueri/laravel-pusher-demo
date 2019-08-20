<template>
    <div class="container">
        <div class="text-center">
            <h2>{{ Auth::user()->name }}</h2>
        </div>
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
                tasks: []
            }
        },

        created() {
            this.fillTask();
            console.log("created");

            window.Echo.channel('canal')
                .listen('EventSocket', (e) => {
                    this.tasks.push(e.task.name);
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
