<template>
      <BackGrCard height="60px">
        <div class="Panel_wrap">
          <ButtonStd title="К списку страниц"  @click="closeThePage()" width="180px" font_size="15px"/>
          <Title title="Настройка карточек услуг" subtitle="instagram-podpishiki"  />
          <ButtonStd @click="updateList" class="btn-right" width="80px"><img src="@/assets/icons/update_w.svg" alt=""></ButtonStd>
        </div>
      </BackGrCard>
      <BackGrCard class="sitePage">
        <div class="wrapePage">
          <div class="page_titile">{{ pageTitile() }}</div>
          <div class="page_discription">{{ pageDiscription() }}</div>
          <div class="cards">
            <div v-for="(item) in data.cards" :key="item.id" class="cardProduct">
              <div class="icon" :style="{'background-image': 'url('+item.img+')'}"></div>
              <div class="title">{{ item.title }}</div>
              <div class="discription">{{ item.description }}</div>
              <div class="price">{{ item.price_title }}</div>
              <div class="button" @click="openPopap(item)"><div class="icon_btn"></div>НАСТРОИТЬ</div>
            </div>
          </div>
        </div>
        <PopupSettingCardProduct :card="selectedCard" v-model="openPopupCard"/>
      </BackGrCard>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'SitePage',
  async mounted(){
    EventBus.on('cardProduct:saved', ()=>{this.updateList()})
  },
  data(){
    return{
      data:'',
      selectedCard:'',
      openPopupCard: false,
    }
  },
  props:{
    pageId:String,
  },
  watch:{
    pageId(){
      this.updateList()
    }
  },
  methods:{
    async updateList(){
      console.log(this.pageId)
      if(this.pageId=='') return false
      let result = await getData('getData.php',{typeData:'page', page_id: this.pageId})
      if(!this.checkResult(result)) return false
      this.data = await result.data
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
    pageTitile(){
      return this.data.page?this.data.page.titile_in_page:''
    },
    pageDiscription(){
      return this.data.page?this.data.page.descr_in_page:''
    },
    closeThePage(){
      EventBus.emit('pages:closeSitePage')
    },
    openPopap(card){
      this.selectedCard = card;
      this.openPopupCard = true;
    }
  },
}
</script>

<style lang="scss" scoped>
  .Panel_wrap{
    display: flex;
    column-gap: 30px;
    align-items: center;
  }

  .sitePage{
    font-family: 'TildaSansBold';  
  }

  .wrapePage{
    margin: 50px auto;
    width: 1200px;
  }

  .page_titile{
    font-size: 30px;
    font-weight: bold;
  }

  .page_discription{
    margin-top: 20px;
    font-size: 14px;
    color: #9D9D9D;
  }

  .cards{
    margin-top: 90px;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
  }

  .cardProduct{
    margin-left: 20px;
    margin-right: 20px;
    width: 360px;
    height: 540px;
    background-color: #ffffff;
    border-radius: 30px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    padding: 45px 30px;
    margin-bottom: 40px;
  

    .icon{
      height: 90px;
      width: 90px;
      margin: 0 auto;
      background-repeat: no-repeat;
      background-position: center;
      background-size: contain;
    }

    .title{
      margin-top: 40px;
      margin-bottom: 25px;
      height: 52px;
      font-size: 20px;
      line-height: 30px;
    }

    .discription{
      margin-top: 18px;
      height: 100px;
      font-family: 'TildaSans';
      font-weight: 300;
      font-size: 14px;
      line-height: 1.3;
    }

    .price{
      margin-top: 25px;
      font-size: 20px;
    }

    .button{
      height: 45px;
      width: 150px;
      margin: auto;
      margin-top: 34px;
      display: flex;
      color: #fff;
      font-size: 14px;
      background-color: #4555f0;
      border-radius: 50px;
      align-items: center;
      justify-content: center;
      cursor: pointer;

      .icon_btn{
        background-image: url('../../assets/icons/menu_left/settings_w.svg');
        width: 20px;
        height: 20px;
        margin-right: 5px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
      }
    }

    .button:hover{
      background-color: #020cc7;
    }
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
</style>