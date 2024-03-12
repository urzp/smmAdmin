<template>
    <Header></Header>
    <MenuLeft selected="users"></MenuLeft>
    <MainContent>
        <CardUser :user="user"/>
    </MainContent>
</template>

<script>
import { getData } from '@/servis/getData.js'
export default {
  name: 'UserPage',
  async mounted(){
    await this.getUser()
    await this.getOrders()
  },
  data(){
    return{
      user_id:this.$route.params.userId,
      user:{},
      orders:{},
      balans:{},
    }
  },
  methods:{
    async getUser(){
      let result  = await getData('getData.php',{typeData:'user', user_id: this.user_id})
      if(!this.checkResult(result)) return false
      this.user = await result.data
    },
    async getOrders(){
      let result  = await getData('getData.php',{typeData:'userOrders', user_id: this.user_id})
      if(!this.checkResult(result)) return false
      this.orders = await result.data
    },
    checkResult(result){
      this.lading = false
      if (result.success) return true
      this.notFound = true
      return false
    }
  }
}
</script>

