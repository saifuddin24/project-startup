<template>
  <input class="border rounded shadow" type="number" placeholder="Year" v-model="y" v-if="minIntervalIndex<=5 && maxIntervalIndex >= 5">
  <input class="border rounded shadow" type="number" placeholder="Month" v-model="mo" v-if="minIntervalIndex<=4 && maxIntervalIndex >= 4">
  <input class="border rounded shadow" type="number" placeholder="Day" v-model="d" v-if="minIntervalIndex<=3 && maxIntervalIndex >= 3">
  <input class="border rounded shadow" type="number" placeholder="Hour" v-model="h" v-if="minIntervalIndex<=2 && maxIntervalIndex >= 2">
  <input class="border rounded shadow" type="number" placeholder="Minute" v-model="m" v-if="minIntervalIndex<=1  && maxIntervalIndex >=1" >
  <input class="border rounded shadow" type="number" placeholder="Second"  v-model="s" v-if="minIntervalIndex<=0 && maxIntervalIndex >= 0">
</template>

<script>

const intervals = [ 'second','minute','hour','day','month','year' ];

export default {
    name: "timer-input",
    components: {},
    emits: [
        'update:year',
        'update:month',
        'update:day',
        'update:hour',
        'update:minute',
        'update:second',
    ],
    props:{
        year: {default:0},
        month: {default:0},
        day: {default:0},
        hour: {default: 0},
        minute: {default:0},
        second: {default:0},
        maxChangeInterval: {default: 'year'},
        minChangeInterval: {default: 'second'},
    },
    data(){
        return { s: 0, m: 0, h: 0, d: 0, mo: 0, y: 0 }
    },
    computed: {
        maxIntervalIndex(){
            return  intervals.indexOf(this.maxChangeInterval);
        },
        minIntervalIndex(){
            return  intervals.indexOf(this.minChangeInterval);
        },
    },
    methods: {
        change_time ( modifier, modifiable, value, factor, interval){

            if( value >= factor ) {
                this[modifiable] += Math.floor(value / factor);
                this[modifier] = value % factor;
            }

            this.$emit( `update:${interval}`, parseInt(this[modifier] ));

            const emitModifiable = intervals[intervals.indexOf( interval )+1];
            if( emitModifiable ) {
                this.$emit( `update:${emitModifiable}`, parseInt(this[modifiable]) );
            }
        }
    },
    mounted() {
        this.s = 59;
    },
    created() {
        const watchers = [
            {
                status: (this.maxIntervalIndex >= 1) ,
                interval: 'second',
                modifier:'s',
                modifiable: 'm',
                factor: 60
            },
            {
                status: (this.maxIntervalIndex >= 2) ,
                interval: 'minute',
                modifier:'m',
                modifiable: 'h',
                factor: 60
            },
            {
                status: (this.maxIntervalIndex >= 3) ,
                interval: 'hour',
                modifier:'h',
                modifiable: 'd',
                factor: 24
            },
            {
                status: (this.maxIntervalIndex >= 4) ,
                interval: 'day',
                modifier:'d',
                modifiable: 'mo',
                factor: 30
            },
            {
                status: (this.maxIntervalIndex >= 5) ,
                interval: 'month',
                modifier:'mo',
                modifiable: 'y',
                factor: 12
            },
        ];

        watchers.forEach( watcher => {
            this.$watch(watcher.modifier,function (value){
                if( watcher.status ) {
                    this.change_time( watcher.modifier,watcher.modifiable, parseInt(value),watcher.factor, watcher.interval )
                }
            });

            this.$watch(watcher.interval,function (value){
                this[watcher.modifier] = parseInt(value);
            });
        });

    }
}
</script>

<style scoped>

</style>
