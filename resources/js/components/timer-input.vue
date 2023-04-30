<template>
  <input class="border rounded shadow" type="number" placeholder="Hour" v-model="h">
  <input class="border rounded shadow" type="number" placeholder="Minute" v-model="m">
  <input class="border rounded shadow" type="number" placeholder="Second" v-model="s">
</template>

<script>

const time_setup = function(type){

    const set = function (value){
        switch (type) {
            case 'second':
                this.$emit( `update:minute`, Math.floor(value/60) );
                this.$emit( `update:${type}`, value%60 );
                break;
        }

    }


    return {
        set,
        get(){
            return this[type];
        }
    }
}


export default {
    name: "timer-input",
    components: {},
    emits: [
        'update:hour',
        'update:minute',
        'update:second',
    ],
    props:{
        hour: {},
        minute: {},
        second: {}
    },
    data(){
        return {

        }
    },
    computed: {
        s: time_setup.call(this,'second'),
        m: time_setup.call(this,'minute'),
        h: time_setup.call(this,'hour')
    },
    methods: {
        input_setup(){

        }
    },
    mounted() {
        this.s = 55;
    }
}
</script>

<style scoped>

</style>
