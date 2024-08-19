<template>
    <Header></Header>
    <MenuLeft selected="settings"></MenuLeft>
    <MainContent>
      <BackGrCard height="500px">
        <Title title="Настройки" style="margin-bottom: 20px;">
          <ButtonStd  title="Сохранить" @click="updateConfigs(); updatePagesFree()"/>
        </Title>
        <BackGrCard height="200px" width="560px" bg_color="#FFFFFF" bg_color_hover="#FFFFFF" border_radius="15px">
          <Title title="Бесплатные заказы" text_size="18px"></Title>
          <Title class="centr_align" title="По умолчанию" text_size="18px" color="#aaa"></Title>
          
          <div class="item_config">
            <div class="name_config">Максимальное количество услуг</div>
            <input type="number" v-model="configs.quantity_max_free_orderd">
          </div>
          <div class="item_config">
            <div class="name_config">Поставшик</div>
            <input type="number" v-model="configs.provider_free_orders">
          </div>
          <div class="item_config">
            <div class="name_config">Ожидания повторного заказа по одной ссылке (ч)</div>
            <input type="number" v-model="configs.pause_free_orders_h">
          </div>
          <div class="line"></div>
          <Title class="centr_align" title="Для страниц" text_size="18px" color="#aaa"></Title>
          <div class="pageRow" v-for="(item, index) in pages_list" :key="item.id" >
            <div class="pageRowWrap">
              <ButtonStd @click="deletePagesFree(item.id, index, item.newPage)" class="btn-left" width="80px"><img src="@/assets/icons/trach.svg" alt=""></ButtonStd>
              <div class="page_configs">
                <div class="item_config">  
                  <div class="name_config">Название страницы</div>
                  <input type="text" v-model="item.page">
                </div>
                <div class="item_config">
                  <div class="name_config">Поставшик</div>
                  <input type="number" v-model="item.id_provider">
                </div>
                <div class="item_config">
                <div class="name_config">Максимальное количество услуг</div>
                  <input type="number" v-model="item.quantity_max">
                </div>
              </div>
            </div>
            <div class="line"></div>
          </div>
          <ButtonStd @click="newPage" class="btn-left" width="80px"><img src="@/assets/icons/btn_pluss.svg" alt=""></ButtonStd>
        </BackGrCard>
      </BackGrCard>
    </MainContent>
    <Toaster/>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
import Toaster from '@/components/UI/Toaster.vue'
export default {
  components: { Toaster },
  name: 'SettingsPage',
  async mounted(){
    this.getConfigs()
    this.getFreePages()
  },
  data(){
    return{
      pages_list:[],
      configs:{},
      namePage: 'vk_free',
    }
  },
  methods:{
    async getConfigs(){
      let result  = await getData('getData.php',{typeData:'configs'})
      if(!this.checkResult(result)) return false
      this.configs = await result.data
    },
    async getFreePages(){
      let result  = await getData('getData.php',{typeData:'freePages'})
      if(!this.checkResult(result)) return false
      this.pages_list = await result.data
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
    async updateConfigs(){
      let result  = await getData('updateData.php',{typeData:'configs', data: this.configs} )
      if(!!result){
        EventBus.emit(`toaster:update`, {success:true, msg:'сохранено'})
      }else{
        EventBus.emit(`toaster:update`, {success:false, msg:'ошибка'})
      }
    },
    async updatePagesFree(){
      let result  = await getData('updateData.php',{typeData:'freePages', data: this.pages_list} )
      if(!!result){
        EventBus.emit(`toaster:update`, {success:true, msg:'сохранено'})
      }else{
        EventBus.emit(`toaster:update`, {success:false, msg:'ошибка'})
      }
      this.getFreePages()
    },
    async deletePagesFree(id_page, index, newPage=false){
      if(newPage){ 
        let filtered = this.pages_list.filter((item) => item.id !== id_page); 
        this.pages_list = filtered
      }else{ 
        await getData('updateData.php',{typeData:'freePages_del', id:id_page} )
        this.getFreePages()
      }
    },
    newPage(){
      let id
      if(this.pages_list.length == 0) {id = 0 }else{ id = Number( this.pages_list[this.pages_list.length - 1].id ) + 1}
      let page = {
        id,
        page: 'имя страницы',
        id_provider: 0,
        quantity_max: 0,
        newPage: true,
      }
      this.pages_list.push(page)
    }
  },
}
</script>

<style scoped>

  main{
    margin-top: 300px;
  }

  .line{
    width: 100%;
    margin-top: 10px;
    margin-bottom: 15px ;
    border: solid 1px #ddd
  }

  .item_config{
    text-align: left;
    color: #565656;
    font-size: 16px;
    margin-bottom: 5px;
    display: flex;
    justify-content: space-between;
    width: 100%;
  }

  .item_config input{
    width: 50px;
    text-align: center;
    border: none;
    background-color: #eff8ff;
    border-radius: 8px;
    padding: 0px 8px;
  }

  .centr_align{
    justify-content: center!important;
  }

  .pageRowWrap{
    display: flex;
    gap: 20px;
    justify-content: space-between;
    align-items: center;
  }

  .page_configs{
    width: 100%;
  }

  .pageRow input[type="text"]{
    width: 250px;
    text-align: right;
  }

</style>