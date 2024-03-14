<template>
    <div v-if="maxPage > 1" class="page_panel" :class="{'page_panel_top':panelTop}" @click.stop="">
    <ButtonPage img="goStart" @click.stop="page=1"><img  src="@/assets/icons/page_panel/goStart.svg" alt=""></ButtonPage>
    <ButtonPage img="goLeft" @click.stop="prPage"><img  src="@/assets/icons/page_panel/goLeft.svg" alt=""></ButtonPage>
    <ButtonPage v-model="page"/>
    <ButtonPage img="goRight" @click.stop="nextPage"><img  src="@/assets/icons/page_panel/goRight.svg" alt=""></ButtonPage>
    <ButtonPage img="goEnd" @click.stop="page=maxPage"><img  src="@/assets/icons/page_panel/goEnd.svg" alt=""></ButtonPage>
    </div>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'PagePanel',
  async mounted(){
    EventBus.on('pageTable:maxPage', (val)=>{this.maxPage=val; this.page=1})
  },
  created () {
    window.addEventListener('scroll', this.handleScroll);
  },
  unmounted () {
    window.removeEventListener('scroll', this.handleScroll);
  },
  data(){
    return{
      page: 1,
      maxPage: 1,
      panelTop:false,
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
    handleScroll (event) {
      if(window.pageYOffset>142){
        this.panelTop = true
      }else{
        this.panelTop = false
      }
    },
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
  .page_panel_top{
    position: fixed;
    right: 246px;
    top: 34px;
  }
</style>