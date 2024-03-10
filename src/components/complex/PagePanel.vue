<template>
    <div v-if="maxPage > 1" class="page_panel">
    <ButtonPage img="goStart" @click="page=1"/>
    <ButtonPage img="goLeft" @click="prPage"/>
    <ButtonPage v-model="page"/>
    <ButtonPage img="goRight" @click="nextPage"/>
    <ButtonPage img="goEnd" @click="page=maxPage"/>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'PagePanel',
  async mounted(){
    EventBus.on('pageTable:maxPage', (val)=>{this.maxPage=val; this.page=1})
  },
  data(){
    return{
      page: 1,
      maxPage: 1,
    }
  },
  watch:{
    page(n_val, o_val){
      if(!n_val||n_val=='') {this.page = 1; n_val=1}
      if(n_val<=0) {this.page = 1; n_val=1}
      if(n_val>this.maxPage) {this.page = this.maxPage; n_val=this.maxPage}
      EventBus.emit('pageTable:update', n_val )
    }
  },
  methods:{
    prPage(){
      if(this.page==1) return false
      --this.page
    },
    nextPage(){
      if(this.page>=this.maxPage) return false
      ++this.page
    }
  }
}
</script>


<style scoped>
  .page_panel{
    display: flex;
    column-gap: 10px;
  }
</style>