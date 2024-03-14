<template>
    <Header></Header>
    <MenuLeft selected="provaders"></MenuLeft>
    <MainContent>
        <BackGrCard>
            <div class="table">
                <TitleTable title="Поставщики"/>
                <TableHeader class="set_width_table" :align="'flex-start'">
                    <h_colum title="#"/>
                    <h_colum title='id'/>
                    <h_colum title='url'/>
                    <h_colum title='api-key'/>
                </TableHeader>
                <TableBody :align="'flex-start'">
                    <div v-for="(item, index) in part_providers" :key="item.id" class="row set_width_table pointer" @click="pop_show(index)">
                        <div>{{ index + 1 + (part - 1)*this.part_items}}</div>
                        <div>{{ item.id_old }}</div>
                        <div class="content_left">{{ item.name }}</div>
                        <div class="content_left">{{ item.api_key }}</div>
                    </div>
                </TableBody>
            </div>
        </BackGrCard>
      <PopupProvider :order="pop_order" v-model="pop_open"/>
    </MainContent>
</template>

<script>
import { getData } from '@/servis/getData.js'
import {coutMaxPages, newPage} from '@/servis/pageControl.js'
import { EventBus } from '@/servis/EventBus'
export default {
  name: 'ProvidersPage',
  async mounted(){
    this.updateList()
    EventBus.on('pageTable:update', (page)=>{
      this.part = page
      this.part_providers = newPage(this.f_providers, page, this.part_items)
    })
  },
  data(){
    return{
        providers:'',
        f_providers:'',
        part_items: 100,
        part:'',
        part_providers:'',
        pop_order:'',
        pop_open:false,
    }
  },
  methods:{
    async updateList(){
      let result = await getData('getData.php',{typeData:'providers'})
      if(!this.checkResult(result)) return false
      this.providers = await result.data
      this.filter()
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    },
    filter(){
      this.f_providers = this.providers
      this.intPage()
    },
    intPage(){
      EventBus.emit('pageTable:maxPage', coutMaxPages(this.f_providers, this.part_items)) 
      this.part = 1
      this.part_providers = newPage(this.f_providers, this.part, this.part_items)
    },
    pop_show(i){
      this.pop_open = true
      let order = this.part_providers[i]
      this.pop_order = order 
    }
  }

}
</script>


<style lang="scss"  scoped>

  .set_width_table>:nth-child(1){
    width: 30px;
  }

  .set_width_table>:nth-child(2){
    min-width: 80px;
  }

  .set_width_table>:nth-child(3){
    min-width: 250px;
  }

  .set_width_table>:nth-child(4){
    min-width: 450px;
  }

</style>