<template>
    <div v-show="true" class="popup_bg_screen" @click.stop="thisClose">
        <div class="popup" >
            <div class="close_btn" @click.stop="close">
                    <img src="@/assets/icons/filters/close.svg" alt="">
            </div>
            <div class="content_wrap">
                <div class="card">
                    <div class="icon" style="background-image: url('https://static.tildacdn.com/tild6632-3337-4263-b336-633037643565/instagram3.svg');"></div>
                    <div class="title">Подписчики Инстаграм дешевые</div>
                    <div class="discription">Пол: смешанный. Низкое качество. Скорость: 10 тыс. в сутки. Гео: мир. Возможны любые списания. Без гарантии. Макс: 250 тыс.</div>
                    <div class="price">0,06 ₽ за шт.</div>
                    <div class="button"><div class="icon_btn"></div>НАСТРОИТЬ</div>
                </div>
                <div class="settings">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'PopupSettingCardProduct',
    data(){
        return{
            pop_order:{},
        }
    },
    props:{
        order:Object,
        modelValue:Boolean,
        userMode:{
            type:Boolean,
            default: false,
        }
    },
    emits: ['update:modelValue'],
    methods:{
        close(){
            this.$emit('update:modelValue', false)
        },
    }
}
</script>


<style lang="scss" scoped>

.popup_bg_screen{
    width: 100vw;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    background-color: #16354dcc;
}

.popup{
    margin: auto;
    margin-top: 200px;
    padding-top: 10px;
    width: 1200px;
    height: 600px;
    border-radius: 30px;
    background-color: #FFFFFF;
}

.close_btn{
    margin-top: 10px;
    margin-left: auto;
    margin-right: 20px;
    width: 35px;
    height: 35px;
    cursor: pointer;
    img{
        width: 100%;
    }
}

.content_wrap{
    display: flex;
}

.card{
    width: 360px;
    height: 500px;
    border-right: 1px solid #D2D2D2;
    padding-left: 20px;
    padding-right: 20px;
}

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
      height: 120px;
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

</style>