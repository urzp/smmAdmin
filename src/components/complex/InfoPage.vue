<template>
    <BackGrCard>
        <div class="title_main">Обновление данных в БД со страниц сайта.</div>
        <div class="sub_title">Обновление данных со страниц сайта которые находятся платформе тильда.</div>
        <div class="text_st">
            Данный необходимо обновлять из аккаунта тильда.<br> 
            Нужно войти в аккаунт тильда и выбрать страницу с сайтом где находятся все страницы и папки сайта.<br>
            Открыть в браузере консоль зля запуска скрипта который будет указан ниже.<br>
            Скопировать, вставить скрипт в консоль и запустить его (клавиша Enter)<br>
            Подождать в районе 1-2 минут когда скрипт отработает и выдаст сообщение о результате его рвботы<br>
        </div>
        <div class="bg_img">
            <img src="@/assets/imgs/inf_page/image_1.jpg" alt="">
        </div>
    </BackGrCard>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
    name: 'InfoPage',
    data(){
        
    }
}
</script>


<style scoped>
    .title_main{
        font-family: 'TildaSansBold';
        font-size: 34px;
        margin-top: 10px;
    }

    .sub_title, .text_st{
        margin-top: 25px;
        font-family: 'TildaSansBold';
        font-size: 14px;
        color: #9D9D9D;
    }

    .text_st{
        margin-top: 40px;
        margin-bottom: 40px;
        margin-left: 150px;
        margin-right: 150px;
        text-align: left;
    }

    .bg_img{
        background-color: #DCDCDC;
        width: 100%;
        padding-top: 80px;
        padding-bottom: 80px;
        padding-left: 150px;
        padding-right: 150px;
    }
    .bg_img img{
        width: 100%;
    }
</style>