<template>
    <Header></Header>
    <MenuLeft selected="settings"></MenuLeft>
    <MainContent>
      <BackGrCard height="500px">
        <Title title="Настройки" style="margin-bottom: 20px;">
          <ButtonStd  title="Сохранить" @click="updateConfigs()"/>
        </Title>
        <BackGrCard height="200px" width="560px" bg_color="#FFFFFF" bg_color_hover="#FFFFFF" border_radius="15px">
          <Title title="Бесплатные заказы" text_size="18px"></Title>
          <div class="line"></div>
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
  },
  data(){
    return{
      configs:{},
    }
  },
  methods:{
    async getConfigs(){
      let result  = await getData('getData.php',{typeData:'configs'})
      if(!this.checkResult(result)) return false
      this.configs = await result.data
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
  }

  .item_config input{
    width: 50px;
    text-align: center;
    border: none;
    background-color: #eff8ff;
    border-radius: 8px;
    padding: 0px 8px;
  }

</style>