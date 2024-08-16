<template>
    <div v-if="show" class="toaster" :class="{'fadeout':fadeout}">
        <BackGrCard width="250px" height="100px" :bg_color="bgColor">
            <div class="msg">{{ msg }}</div>
        </BackGrCard>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default{
    name:'Toaster',
    async mounted(){
        EventBus.on('toaster:update',(data)=>{
            if(data.success){ this.bgColor="#499865" }else{ this.bgColor="#8c0000" }
            this.msg = data.msg
            this.show = true;
            setTimeout(()=>{ this.fadeout = true;}, 100)
            setTimeout(()=>{
                this.fadeout = false;
                this.show = false;
            }, 2000)
        })
    },
    data(){
        return{
            bgColor: '#fff',
            msg: '',
            show: false,
            fadeout: false,
        }
    }
}
</script>

<style scoped>
    .toaster{
        position: absolute;
        right: 0px;
        bottom: 0px;
        opacity: 1.0;
    }
    .msg{
        color: #fff;
        font-size: 24px;
    }
    .fadeout{
        opacity: 0.0;
        transition: opacity 2s;
    }
</style>