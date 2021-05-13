<template>
<div>
    <div class="form-group row">
            <label  class="col-md-4 col-form-label text-md-right">State</label>

            <div class="col-md-6">
                <select  v-model="selected" id="state" type="text" class="form-control" name="state" value="0" required autofocus>
                    <option value="0">Izaberite</option>
                    <option v-for="state in states" :key="state.id" v-bind:value="state.id" >{{state.name.sr}}</option>
                </select>

            </div>

    </div>
    <div class="form-group  row">
        <label  class="col-md-4 col-form-label text-md-right">City</label>
        <div class="col-md-6">

            <select id="city" type="text" class="form-control" name="city" value="0" required autofocus>
                <option value="0">Izaberite</option>
                <option v-for="city in cities" :key="city.id" v-bind:value="city.id" >{{city.name.sr}}</option>
            </select>

        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            this.fetchData()
        },
        data(){
            return {
                selected: '0',
                cities:[],
                states:[]
            }

        },watch: {
            selected: function(val) {
                axios.get("api/city/"+val)
                    .then((res)=>{
                        this.cities=res.data
                    }).catch((err)=>{console.log(err)})
            }
        },
        methods:{
            fetchData(){
                axios.get("api/state")
                    .then((res)=>{
                        this.states=res.data
                    }).catch((err)=>{console.log(err)})
            }
        }
    }
</script>
