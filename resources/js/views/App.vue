<template>
    <div>
        {{todo}}
    </div>
</template>
<script>
    const default_layout = "default";
    const axios = require('axios').default;


    export default {
        computed: {},
        data() {
            return {
                todo: '',
            }
        },
        async mounted() {
            this.todo = await axios.get('https://jsonplaceholder.typicode.com/todos/1');
        }
    };
</script>
