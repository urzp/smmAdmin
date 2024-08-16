<template>
    <div class="menu-fix-vacuum"></div>
    <div class="menu_left">
        <div class="menu-list">
            <div class="menu-item" :class="{'active':selectedItem.main}" @click="$router.push('/')">
                <img v-if="selectedItem.main" src="../../assets/icons/menu_left/home_w.svg" alt="users">
                <img v-else  src="../../assets/icons/menu_left/home_b.svg" alt="users">
                <div class="memu-item-lab">Главная</div>
            </div>
            <div class="menu-item" :class="{'active':selectedItem.users}" @click="$router.push('/users')">
                <img v-if="selectedItem.users" src="../../assets/icons/menu_left/users_w.svg" alt="users">
                <img v-else  src="../../assets/icons/menu_left/users_b.svg" alt="users">
                <div class="memu-item-lab">Пользователи</div>
            </div>
            <div class="menu-item"  :class="{'active':selectedItem.orders}" @click="$router.push('/orders')">
                <img v-if="selectedItem.orders" src="../../assets/icons/menu_left/orders_w.svg" alt="users">
                <img v-else  src="../../assets/icons/menu_left/orders_b.svg" alt="users">
                <div class="memu-item-lab">Заказы</div>
            </div>
            <div class="menu-item"  :class="{'active':selectedItem.servis}" @click="$router.push('/sitePages')">
                <img v-if="selectedItem.servis" src="../../assets/icons/menu_left/servis_w.svg" alt="users">
                <img v-else  src="../../assets/icons/menu_left/servis_b.svg" alt="users">
                <div class="memu-item-lab">Услуги</div>
            </div>
            <div  class="menu-item"  :class="{'active':selectedItem.provaders}" @click="$router.push('/provaders')">
                <img v-if="selectedItem.provaders" src="../../assets/icons/menu_left/prov_w.svg" alt="users">
                <img v-else  src="../../assets/icons/menu_left/prov_b.svg" alt="users">
                <div class="memu-item-lab">Поставщики</div>
            </div>
            <div  class="menu-item"  :class="{'active':selectedItem.settings}" @click="$router.push('/settings')">
                <img v-if="selectedItem.settings" src="../../assets/icons/menu_left/settings_w.svg" alt="users">
                <img v-else  src="../../assets/icons/menu_left/settings_b.svg" alt="users">
                <div class="memu-item-lab">Настройки</div>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: 'MenuLeft',
    data(){
    },
    props:{
        selected: String,
    },
    computed:{
        selectedItem(){
            let out ={
                main:false,
                users: false,
                orders: false,
                servis: false,
                provaders: false,
                settings:false,
            }
            out[this.selected] = true
            return out
        }
    },
}
</script>

<style lang="scss" scoped>
.menu-fix-vacuum{
    width: 250px;
    height: calc(100vh - 100px);  
    float: left; 
}
@media (max-width: 1499.98px) {
    .menu-fix-vacuum{
        width: 0px;
    }
}

.menu-hide{
    left:-250px!important;
}
.menu_left{
    left: 0px;
    width: 250px;
    height: calc(100vh - 100px);
    position: fixed;
    background-color: #E4E5EA;
    box-shadow: 0 2px 2px #00000030;
    transition: 1s;
    

    .menu-list{
        padding-top: 50px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .menu-item{
        height: 34px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        column-gap: 10px;
        font-size: 15px;
        cursor: pointer;

        img{
            margin-left: 15px;
        }
    }

    .active{
        background-color: #6B99C3;
        border-radius: 20px;
        font-family: 'Play-Bold';
        color: #fff;
    }
}
</style>
