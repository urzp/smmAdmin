<template>
    <Header></Header>
    <MenuLeft selected="servis"></MenuLeft>
    <MainContent>
      <BackGrCard height="60px" :class="{collapse:collapse, displayNone:displayNone}" >
        <div class="buttons_wrap">
          <Title title="Список страниц сайта"/>
          <ButtonStd @click="$router.push('/pages')" class="btn-right" width="80px"><img src="@/assets/icons/update_w.svg" alt=""></ButtonStd>
        </div>
      </BackGrCard>
      <BackGrCard :class="{collapse:collapse, displayNone:displayNone}">
        <div class="table">
          
          <TableHeader v-if="false" class="set_width_table">
            <h_colum title="#"/>
            <h_colum title='Имя'  type_f='find' v-model="transaction_f" class="content_left"/>
            <h_colum title='url' type_f='true_false' v-model="url_f" l_true="есть url" l_false="без url"/>
          </TableHeader>
          <TableBody>
            <div v-for="(item) in part_data_list" :key="item.id" class="row set_width_table pointer" @click="list_open_close(item)" :class={page_item:!item.folder}>
              <div v-if="item.folder" :class={icon_folder:item.folder} :style="{'background-image': 'url('+item.pages[0].img+')'}"></div>
              <div v-else></div>
              <div class="content_left" >{{ item.name }}</div>
              <div class="content_left">{{ item.url }}</div>
            </div>
          </TableBody>
        </div>  
      </BackGrCard>
      <div class="animateOpen" :class="{collapse:!uncolapse, displayNone:!displayNone}">
        <SitePage :pageId="activePageId"/>
      </div>
    </MainContent>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import {coutMaxPages, newPage} from '@/servis/pageControl.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'SitePages',
  async mounted(){
    this.updateList()
    EventBus.on('pageTable:update', (page)=>{
      this.part = page
      this.part_data_list = newPage(this.f_data_list, page, this.part_items)
    })
    EventBus.on('pages:closeSitePage', ()=>{
      this.closeSitePage()
    })
  },
  data(){
    return{
      scrollPosition:'',
      activePageId:'',
      data_list:'',
      f_data_list:'',
      part:'',
      part_items: 100,
      part_data_list:'',
      url_f:'',
      collapse: false,
      uncolapse: false,
      displayNone:false
    }
  },
  watch:{
    url_f(){
      this.filter();
    },
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'pages'})
      if(!this.checkResult(result)) return false
      this.data_list = await result.data
      this.adapter()
      this.filter();
    },
    async adapter(){
      this.data_list.forEach(item=>{
        item.folder = true
        item.uncover = false 
      })
    },
    async filter(){
      let result = []
      //result.push(...this.data_list)
      let url_f = this.url_f
      this.data_list.forEach( (item, index)=>{
        result.push(item)
        if(item.uncover){
          item.pages.forEach((page)=>{
            result.push({
              id: page.id,
              name: page.title,
              img: page.img,
              url: page.url,
            })
          })
        }
      })

      if(url_f!=''){
        if(url_f=='true') result = result.filter(i=>i.link!='')
        if(url_f=='false') result = result.filter(i=>i.link=='')
      }  
      this.f_data_list = result
      this.intPage()
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
    conv_val(val){
      if(val==''||val=='none') return '-'
      val = val.replace(/['"{}]+/g , '')
      return val
    },
    intPage(){
      EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_data_list, this.part_items)) 
      this.part = 1
      this.part_data_list = newPage(this.f_data_list, this.part, this.part_items)
    },
    op_f(name){
      EventBus.emit(`${name}:open`)
    },
    getFromTodayString(days=0){
      let today = new Date()
      let result = new Date(today.setDate(today.getDate() - days))
      return result.toISOString().split('T')[0]
    },
    list_open_close(item){
      if(!item.folder){ 
        this.activePageId = item.id;
        //this.$router.push(`/page/${item.id}`);
        this.openSitePage()
        return false
      }
      let id = item.id
      let found = this.data_list.find(item => item.id == id);
      if(!found) return false
      found.uncover = !found.uncover
      this.filter()
    },
    openSitePage(){
      this.scrollPosition =  window.pageYOffset 
      this.collapse = true;
      setTimeout(()=>{
        this.displayNone = true
      }, 500)
      setTimeout(()=>{
        this.uncolapse = true
      },600)
      setTimeout(()=>{
        window.scroll({
          top: 0,
          behavior: "smooth",
        });
      },1000)
    },
    closeSitePage(){
      this.uncolapse = false
      setTimeout(()=>{
        this.displayNone = false
      }, 500)
      setTimeout(()=>{
        this.collapse = false;
      },600)
      setTimeout(()=>{
        window.scroll({
          top: this.scrollPosition,
          behavior: "smooth",
        });
      },1000)
    }
  }
}
</script>

<style lang="scss" scoped>
  .buttons_wrap{
    display: flex;
    column-gap: 30px;
  }

  .animateOpen{
    width: 100%;
    transition: 0.3s;
  }
</style>

<style lang="scss"  scoped>

  .set_width_table>:nth-child(1){
    width: 100px;
  }

  .set_width_table>:nth-child(2){
    min-width: 130px;
    width: 70%;
  }

  .set_width_table>:nth-child(3){
    min-width: 80px;
    width: 30%;
  }

  .page_item{
    color: #afafaf;
  }

  .icon_folder, .icon_page{
    height: 50px;
    margin: 10px 0;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
  }

  .pointer{
    cursor: pointer;
    transition: 0.3s;
  }

  .pointer:hover:not(.title-table){
    background-color: #6B99C3;
    color:#fff;
    transition: 0.3s;
  }



  .collapse{
    width: 0!important;
    opacity: 0;
  }

  .displayNone{
    display: none;
  }

</style>