<template>
  <BackGrCard>
    <div class="table">
      <TitleTable title="Баланс пользователя" :subtitle="`от ${date_f.from} до ${date_f.until}`" />
      <TableHeader class="set_width_table">
        <h_colum title="#"/>
        <h_colum title='Дата время' type_f="date" v-model="date_f" :click_hand="date_f_click"/>
        <h_colum title='Транзакция'/>
        <h_colum title='Баланс до'/>
        <h_colum title='Сумма'/>
        <h_colum title='Баланс после' />
        <h_colum title='Проверка'/>
        <h_colum title=''/>
      </TableHeader>
      <TableBody>
        <div v-for="(item, index) in part_payments" :key="item.id" class="row set_width_table" >
          <div>{{ index + 1 + (part - 1)*this.part_items}}</div>
          <div class="content_left">{{ item.datetime }}</div>
          <div class="content_right">{{ item.trnsaction }}</div> 
          <div class="content_right">{{ item.oldBalans}} p.</div>
          <div class="content_right">{{ item.sum }} p.</div>
          <div class="content_right">{{ item.newBalans }} p.</div>
          <div class="content_left">{{ item.check }}</div>
          <div class="content_left"></div>
        </div>
      </TableBody>
    </div>  
  </BackGrCard>
  <PopupOrder userMode :order="pop_order" v-model="pop_open"/>
</template>

<script>
import { getData } from '@/servis/getData.js'
import { EventBus } from '@/servis/EventBus'
import {coutMaxPages, newPage} from '@/servis/pageControl.js'
export default {
name: 'TableUserUpBalans',
async mounted(){
this.updateList()
EventBus.on('pageTable:update', (page)=>{
  this.part = page
  this.part_payments = newPage(this.f_payments, page, this.part_items)
})
},
data(){
return{
  orders:'',
  payments:'',
  part:'',
  part_items: 100,
  f_payments:'',
  part_payments:{},
  date_f:{
    until: this.getFromTodayString(),
    from:  '2024-01-01'
  },
  date_f_click: false,
  pop_order:{},
  pop_open:false,
}
},
props:{
user_id:String,
},
watch:{
status_f(){
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
  let result = await getData('getData.php',{typeData:'userPaumentBalans', user_id:this.user_id, date_from:this.date_f.from, date_until:this.date_f.until})
  if(!this.checkResult(result)) return false
  this.payments = await result.data
  result = await getData('getData.php',{typeData:'userOrders', user_id:this.user_id, date_from:this.date_f.from, date_until:this.date_f.until})
  if(!this.checkResult(result)) return false
  this.orders = await result.data
  this.filter();
},
async filter(){
  this.orders.forEach( (e, i) => {
    this.orders[i].sum = "-"+ e.sum
  });
  let orders_success = this.orders.filter(i=>i.provader_status.indexOf('false')==-1)

  let result = []
  result.push(...this.payments)
  result.push(...orders_success)
  result = result.sort((a,b)=>{
    let res;
    a = new Date(a.datetime)
    b = new Date(b.datetime)
    if(a > b) res = 1;
    if(a == b) res = 0;
    if(a < b) res = -1;
    return res
  }) 

 
  this.f_payments = result
  this.checkBalanse()
  this.intPage()
},
checkBalanse(){
  this.f_payments.forEach((e, i)=>{
      if(i + 2 > this.f_payments.length) return false
      let a = this.f_payments[i].newBalans
      let b = this.f_payments[i+1].oldBalans
      let result
      if(a==b){
        result = 'success'
      }else{
        result = 'fall'
      }
      this.f_payments[i+1]['check'] = result
  })
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
  EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_payments, this.part_items) )
  this.part = 1
  this.part_payments = newPage(this.f_payments, this.part, this.part_items)
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
  let order = this.part_payments[i]
  this.pop_order = order 
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
min-width: 100px;
}

.set_width_table>:nth-child(4){
min-width: 100px;
}

.set_width_table>:nth-child(5){
min-width: 100px;
}

.set_width_table>:nth-child(6){
min-width: 100px;
}

.set_width_table>:nth-child(7){
min-width: 50px;

}

.set_width_table>:nth-child(8){

width: 40%;
}


</style>