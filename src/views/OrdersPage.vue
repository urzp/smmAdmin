<template>
    <Header></Header>
    <MenuLeft selected="orders"></MenuLeft>
    <MainContent>
      <BackGrCard height="60px">
        <div class="buttons_wrap">
          <ButtonStd title="Незарегистрированные" width="250px" font_size="15px"></ButtonStd>
          <ButtonStd title="Зарегистрированные" width="250px" font_size="15px"></ButtonStd>
        </div>
      </BackGrCard>
      <BackGrCard>
        <div class="table">
          <TitleTable title="Заказы не зарегистрированных пользователей"/>
          <TableHeader class="set_width_table">
            <h_colum title="#"/>
            <h_colum title='Дата время'/>
            <h_colum title='Транзакция'  type_f='find' v-model="transaction_f"/>
            <h_colum title='Email' type_f='find' v-model="email_f"/>
            <h_colum title='Кол-во' type_f='true_false' v-model="qunt_f" l_true="вверх" l_false="вниз"/>
            <h_colum title='Сумма' type_f='true_false' v-model="sum_f" l_true="вверх" l_false="вниз"/>
            <h_colum title='url' type_f='true_false' v-model="url_f" l_true="есть url" l_false="без url"/>
            <h_colum title='статус' type_f='true_false' v-model="status_f"/>
            <h_colum title='msg'/>
          </TableHeader>
          <TableBody>
            <div v-for="(item, index) in part_orders" :key="item.id" class="row set_width_table" >
              <div>{{ index + 1 + (part - 1)*100}}</div>
              <div class="content_left">{{ item.datetime }}</div>
              <div>{{ item.transaction }}</div>
              <div class="content_left">{{ item.email }}</div>
              <div class="content_right">{{ item.quantity }}</div>
              <div class="content_right">{{ item.sum }} p.</div>
              <div class="content_left">{{ item.link }}</div>
              <div>{{ conv_val(item.provader_status) }}</div>
              <div class="content_left">{{ conv_val(item.provader_msg) }}</div>
            </div>
          </TableBody>
        </div>  
      </BackGrCard>
    </MainContent>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'OrderPage',
  async mounted(){
    this.updateList()
    EventBus.on('pageTable:update', this.newPage)
  },
  data(){
    return{
      orders:'',
      part:'',
      f_orders:'',
      part_orders:'',
      transaction_f:'',
      email_f:'',
      qunt_f:'',
      sum_f:'',
      url_f:'',
      status_f:'',
    }
  },
  watch:{
    status_f(){
      this.filter();
    },
    url_f(){
      this.filter();
    },
    sum_f(){
      this.filter();
    },
    qunt_f(){
      this.filter();
    },
    email_f(){
      this.filter();
    },
    transaction_f(){
      this.filter();
    },
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'orders'})
      if(!this.checkResult(result)) return false
      this.orders = await result.data
      this.filter();
    },
    async filter(){
      let result = []
      result.push(...this.orders)
      let status_f = this.status_f
      let url_f = this.url_f
      let sum_f = this.sum_f
      let qunt_f = this.qunt_f
      let email_f = this.email_f
      let transaction_f = this.transaction_f
      if(transaction_f!=''){
        result = result.filter(i=>i.transaction.indexOf(transaction_f)!=-1)
      }
      if(email_f!=''){
        result = result.filter(i=>i.email.indexOf(email_f)!=-1)
      }
      if(qunt_f!=''){
        result = result.sort((a,b)=>{
          let res;
          a = Number(a.quantity)
          b = Number(b.quantity)
          if(a > b) res = 1;
          if(a == b) res = 0;
          if(a < b) res = -1;
          if(qunt_f == 'false') res = res*(-1)
          return res
        })
      }
      if(sum_f!=''){
        result = result.sort((a,b)=>{
          let res;
          a = Number(a.sum)
          b = Number(b.sum)
          if(a > b) res = 1;
          if(a == b) res = 0;
          if(a < b) res = -1;
          if(sum_f == 'false') res = res*(-1)
          return res
        }) 
      }
      if(url_f!=''){
        if(url_f=='true') result = result.filter(i=>i.link!='')
        if(url_f=='false') result = result.filter(i=>i.link=='')
      }  
      if(status_f!=''){
        if(status_f=='true') result = result.filter(i=>i.provader_status=='success')
        if(status_f=='false') result = result.filter(i=>i.provader_status=='fall')
      }
      this.f_orders = result
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
      return val
    },
    coutMaxPages(){
      return Math.floor(1+this.f_orders.length/100) 
    },
    intPage(){
      EventBus.emit('pageTable:maxPage', this.coutMaxPages() )
      this.part = 1
      this.part_orders = this.f_orders.slice(0, 100)
    },
    newPage(page){
      this.part = page
      this.part_orders = this.f_orders.slice(0+100*(page-1), 100*page)
    },
    op_f(name){
      EventBus.emit(`${name}:open`)
    }
  }
}
</script>

<style scoped>
  .buttons_wrap{
    display: flex;
    column-gap: 30px;
  }
</style>

<style lang="scss"  scoped>

  .set_width_table>:nth-child(1){
    width: 30px;
  }

  .set_width_table>:nth-child(2){
    min-width: 130px;
  }

  .set_width_table>:nth-child(3){
    min-width: 80px;
  }

  .set_width_table>:nth-child(4){
    min-width: 250px;
  }

  .set_width_table>:nth-child(5){
    min-width: 50px;
  }

  .set_width_table>:nth-child(6){
    min-width: 50px;
  }

  .set_width_table>:nth-child(7){
    min-width: 200px;
    width: 30%;
  }

  .set_width_table>:nth-child(8){
    min-width: 80px;
  }

  .set_width_table>:nth-child(9){
    min-width: 150px;
  }


</style>