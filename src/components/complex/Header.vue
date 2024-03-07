<template>
    <div class="header-wrap">
        <template v-if="logget">
            <div class="logo"><img src="../../assets/imgs/Group 43.png" alt="logo" @click="$router.push({ path: '/' })"></div>
            <ButtonStd class="btn-right"  title="Выйти" @click="logout" :bg_color_hover="'#496781'"></ButtonStd>
        </template>
    </div>
</template>

<script>
import { isLogget } from '../../servis/islogget.js';

export default {
    async mounted(){
        this.logget = await isLogget();
    },
    name: 'Header',
    data(){
        return{
            logget: false,
        }
    },
    methods:{
        logout(){
            sessionStorage.setItem('user', '');
            sessionStorage.setItem('session', '');
            this.$router.push({ path: '/login' })
        }
    }
}
</script>


<style lang="scss" scoped>
  .header-wrap{
    width: 100%;
    height: 100px;
    padding: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #16354D;
    
    .logo{
        cursor: pointer;
    }
  }


</style>
