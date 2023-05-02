<template>
    <div class="flex w-full flex-col items-center gap-8">


        <div class="flex max-w-4xl w-full justify-between">
            <div>
                Year: {{year}}
                Month: {{month}}
                Day: {{day}}
                Hour: {{hour}}
                Minute: {{minute}}
                Second: {{second}}
            </div>
            <div class="flex gap-3">
                <input type="number" class="border rounded shadow" v-model="time">
                <input type="button" @click.prevent="second=time"
                       value="Set"
                       class="border rounded shadow bg-green-400 px-4 cursor-pointer">
            </div>
        </div>

        <div class="flex max-w-4xl justify-between gap-3">
            <timer-input
                v-model:year="year"
                v-model:month="month"
                v-model:day="day"
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
                year:0,
                month:0,
                day:0,
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
