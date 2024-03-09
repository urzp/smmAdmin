<template>
    <div class="header-wrap">
        <template v-if="logget">
            <div class="menu-btn" @click="toggle_menu()"><img src="../../assets/icons/menuBtn.svg" alt=""></div>
            <div class="logo"><img src="../../assets/imgs/Group 43.png" alt="logo" @click="$router.push({ path: '/' })"></div>
            <ButtonStd class="btn-right"  title="Выйти" @click="logout" :bg_color_hover="'#496781'"></ButtonStd>
        </template>
    </div>
    <div class="header-fix-vacuum"></div>
</template>

<script>
import { isLogget } from '../../servis/islogget.js';

export default {
    async mounted(){
        this.logget = await isLogget();
        this.menu_def()
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
        },
        toggle_menu(){
            let menu = document.getElementsByClassName('menu_left')[0]
            if(menu.classList.contains("menu-hide")){
                menu.classList.remove("menu-hide")
            }else{
                menu.classList.add("menu-hide")
            }
            
        },
        hide_menu(){
            let menu = document.getElementsByClassName('menu_left')[0]
            menu.classList.add("menu-hide")  
        },
        show_memu(){
            let menu = document.getElementsByClassName('menu_left')[0]
            menu.classList.remove("menu-hide")
        },
        swith_menu_by_screent_w(){
            if(window.screen.width>=1500){
                    this.show_memu()
                }else{
                    this.hide_menu()
                }
        },
        menu_def(){
            this.swith_menu_by_screent_w()
            window.addEventListener('resize', this.swith_menu_by_screent_w, true);
        }
    }
}
</script>


<style lang="scss" scoped>
   .menu-btn{
    margin-left: 50px;
    margin-right: 150px;
   }
   @media (min-width: 1500px) {
        .menu-btn{
            display: none;
        }
   }
  .header-wrap{
    width: 100%;
    height: 100px;
    padding: 20px;
    position: fixed;
    display: flex;
    align-items: center;
    background-color: #16354D;
    
    .logo{
        display: flex;
        align-items: center;
        cursor: pointer;
    }
  }

  .header-fix-vacuum{
    width: 100%;
    height: 100px;   
  }


</style>
