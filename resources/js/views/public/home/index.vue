<template>
    <div class="flex w-full flex-col items-center gap-3">


        <div class="flex w-full justify-center gap-3">
            <div>
                Second: {{hour}}
                Second: {{minute}}
                Second: {{second}}
            </div>
            <input type="number" class="border rounded shadow" v-model="time">
            <input type="button" @click.prevent="second=time"
                   value="Set"
                   class="border rounded shadow bg-green-400 px-4 cursor-pointer">
        </div>

        <div class="flex w-full justify-center gap-3">
            <timer-input
                v-model:hour="hour"
                v-model:minute="minute"
                v-model:second="second"
            ></timer-input>

        </div>
    </div>
</template>
<script>

    import TimerInput from "../../../components/timer-input";
    export default {
        name:'homepage',
        components: {TimerInput},
        data(){
            return {
                hour:0,
                minute:0,
                second:0,
                time:0,
            }
        },
        computed: {

        },
        created() {

        }
    }
</script>
