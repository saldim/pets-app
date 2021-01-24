<template>
    <div>
        {{items}}
    </div>
</template>
<script>
    const default_layout = "default";
    const axios = require('axios').default;


    export default {
        computed: {},
        data() {
            return {
                items: '',
            }
        },
        async mounted() {
            this.items = await axios.get('/api/pet');
        }
    };
</script>
