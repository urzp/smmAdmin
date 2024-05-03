<template>
    <Header></Header>
    <MenuLeft selected="orders"></MenuLeft>
    <MainContent>
      <BackGrCard height="60px">
        <div class="buttons_wrap">
          <ButtonStd title="Общие" @click="updateList" width="250px" font_size="15px"/>
          <ButtonStd title="Пользователей" @click="$router.push('/orders/users')" width="250px" font_size="15px"/>
          <ButtonStd @click="updateList" class="btn-right" width="80px"><img src="@/assets/icons/update_w.svg" alt=""></ButtonStd>
        </div>
      </BackGrCard>
      <BackGrCard>
        <div class="table">
          <TitleTable title="Общие заказы" :subtitle="`от ${date_f.from} до ${date_f.until}`" @click="date_f_click = !date_f_click" class="pointer"/>
          <TableHeader class="set_width_table">
            <h_colum title="#"/>
            <h_colum title='Дата время' type_f="date" v-model="date_f" :click_hand="date_f_click"/>
            <h_colum title='Транзакция'  type_f='find' v-model="transaction_f"/>
            <h_colum title='Email' type_f='find' v-model="email_f"/>
            <h_colum title='Кол-во' type_f='true_false' v-model="qunt_f" l_true="вверх" l_false="вниз"/>
            <h_colum title='Сумма' type_f='true_false' v-model="sum_f" l_true="вверх" l_false="вниз"/>
            <h_colum title='url' type_f='true_false' v-model="url_f" l_true="есть url" l_false="без url"/>
            <h_colum title='статус' type_f='true_false' v-model="status_f"/>
            <h_colum title='msg'/>
            <h_colum title='Старт'/>
            <h_colum title='Остаток'/>
            <h_colum title='Прогресс' type_f='find' v-model="prog_staus_f" f_left/>
          </TableHeader>
          <TableBody>
            <div v-for="(item, index) in part_orders" :key="item.id" class="row set_width_table pointer" @click="pop_show(index)">
              <div>{{ index + 1 + (part - 1)*this.part_items}}</div>
              <div class="content_left">{{ item.datetime }}</div>
              <div>{{ item.transaction }}</div> 
              <div class="content_left">{{ item.email }}</div>
              <div class="content_right">{{ item.quantity }}</div>
              <div class="content_right">{{ item.sum }} p.</div>
              <div class="content_left">{{ item.link }}</div>
              <div>{{ conv_val(item.provader_status) }}</div>
              <div class="content_left">{{ conv_val(item.provader_msg) }}</div>
              <div class="content_right">{{ item.start_count }}</div>
              <div class="content_right">{{ item.progress_remains }}</div>
              <div class="content_left">{{ item.progress_status }}</div>
            </div>
          </TableBody>
        </div>  
      </BackGrCard>
      <PopupOrder :order="pop_order" v-model="pop_open"/>
    </MainContent>
  </template>

<script>
import { getData } from '@/servis/getData.js'
import {coutMaxPages, newPage} from '@/servis/pageControl.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'OrderPage',
  async mounted(){
    this.updateList()
    EventBus.on('pageTable:update', (page)=>{
      this.part = page
      this.part_orders = newPage(this.f_orders, page, this.part_items)
    })
  },
  data(){
    return{
      orders:'',
      f_orders:'',
      part:'',
      part_items: 100,
      part_orders:'',
      date_f:{
        until: this.getFromTodayString(),
        from:  this.getFromTodayString(7),
      },
      date_f_click: false,
      transaction_f:'',
      email_f:'',
      qunt_f:'',
      sum_f:'',
      url_f:'',
      status_f:'',
      prog_staus_f:'',
      pop_order:{},
      pop_open:false,
    }
  },
  watch:{
    prog_staus_f(){
      this.filter();
    },
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
    date_f:{
      handler(n_v,o_l){
        this.updateList()
      }, 
      deep: true
    }
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'orders', typeOrders:'not_users' ,date_from:this.date_f.from, date_until:this.date_f.until})
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
      let prog_staus_f = this.prog_staus_f
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
        if(status_f=='false') result = result.filter(i=>i.provader_status=='fall'||i.provader_status=='false')
      }
      if(prog_staus_f!=''){
        result = result.filter(i=>i.progress_status.indexOf(prog_staus_f)!=-1)
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
      val = val.replace(/['"{}]+/g , '')
      return val
    },
    intPage(){
      EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_orders, this.part_items)) 
      this.part = 1
      this.part_orders = newPage(this.f_orders, this.part, this.part_items)
    },
    op_f(name){
      EventBus.emit(`${name}:open`)
    },
    getFromTodayString(days=0){
      let today = new Date()
      let result = new Date(today.setDate(today.getDate() - days))
      return result.toISOString().split('T')[0]
    },
    pop_show(i){
      this.pop_open = true
      let order = this.part_orders[i]
      this.pop_order = order 
    }
  }
}
</script>

<style lang="scss" scoped>
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
    width: 200px;
  }

  .set_width_table>:nth-child(5){
    min-width: 50px;
  }

  .set_width_table>:nth-child(6){
    min-width: 50px;
  }

  .set_width_table>:nth-child(7){
    min-width: 200px;
    width: 25%;
  }

  .set_width_table>:nth-child(8){
    min-width: 80px;
  }

  .set_width_table>:nth-child(9){
    min-width: 150px;
    width: 10%;
  }

  .set_width_table>:nth-child(10){
    width: 50px;
  }

  .set_width_table>:nth-child(11){
    width: 50px;
  }

  .set_width_table>:nth-child(12){
    width: 80px;
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