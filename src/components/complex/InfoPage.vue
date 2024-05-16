<template>
    <BackGrCard>
        <ButtonStd @click="closeInfoPage()" class="btn-left" width="80px"><img src="@/assets/icons/back.svg" alt=""></ButtonStd>
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
        <div class="bg_img">
            <img src="@/assets/imgs/inf_page/image_2.jpg" alt="">
        </div>
        <div class="bg_img">
            <img src="@/assets/imgs/inf_page/image_3.jpg" alt="">
        </div>
        <div class="bg_img">
            <img src="@/assets/imgs/inf_page/image_4.jpg" alt="">
        </div>
        <div class="title">Скрипт для запуска обновления </div>
        <div class="bg_script">
            <div class="script">
                const URL_UPDATE_PAGES = 'https://smmbakparse.ru/php/listPageWrite.php'<br>
                const URL_UPDATE_CARDS = 'https://smmbakparse.ru/php/parceCardProducts.php'<br>
                const AJAX_OPTIONS = { type: 'POST', headers: { 'Content-Type': 'application/json;charset=utf-8' }, }<br>
                let data = { folders, pages }<br>
                <br>
                async function ajaxReq(url, options, content){<br>
                    let response = await fetch(url,{<br>
                        method: options.type,<br>
                        headers: options.heders,<br>
                        body: JSON.stringify(content)<br>
                    })<br>
                    return await response.json();<br>
                }<br>
                <br>
                let result = await ajaxReq(URL_UPDATE_PAGES, AJAX_OPTIONS, data)<br>
                console.log(result.msg)<br>
                result = await ajaxReq(URL_UPDATE_CARDS, AJAX_OPTIONS, {})<br>
                console.log(result.msg)<br>
            </div>
        </div>
        <div class="title">Какие данные обновляются и как все работает</div>
        <div class="text_st">
            Обновляются структура папки-страницы.<br>
            Обновляются названия папок<br>
            Обновляется данные страниц, это названия, url ссылка, иконка страницы,<br> 
            Обновляются данные карточек на страницах, это  название, иконка, описание, цена в карточке.<br>
            Если на странице присутствует старый скрипт в котором описаны настройки, id поставщика, сервиса и других полей то эти данные тоже обновляются в базе данных на сервере.<br>
            <br>
            Текущая административная панель управления работает с данными которые находятся в БД(база данных) сервера, которые мы обновили вышеуказанным способом.<br>
            <br>
            На страницах сайта для клиента где старый скрипт с настройками отключен или удален, данные для заказа (id поставщика, сервис и тд) подгружаются новым скриптом из БД сервера. Новый скрипт в тильде находится в папке Footer которая подключается ко всем страницам сайта автоматически. <br>
            <br>
            Контроль цен для защиты от изменения цены в заказе осуществляется в скрипте php на сервере. Сравниваются цена в заказе и цена которая находится в БД<br>
        </div>
        <div class="bg_img">
            <img src="@/assets/imgs/inf_page/image_5.jpg" alt="">
        </div>
    </BackGrCard>
</template>

<script>
import { EventBus } from '@/servis/EventBus'
export default {
    name: 'InfoPage',
    data(){
        
    },
    methods:{
        closeInfoPage(){
            EventBus.emit('showInfoPage', false)
        }
    }
}
</script>


<style scoped>
    .title_main, .title{
        font-family: 'TildaSansBold';
        font-size: 34px;
        margin-top: 50px;
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
        margin-bottom: 40px;
    }
    .bg_img img{
        width: 100%;
    }

    .bg_script{
        margin-top: 40px;
        margin-bottom: 40px;
        margin-left: 150px;
        margin-right: 150px;
        padding: 45px 65px;
        background-color: #fff;
    }
    .script{
        text-align: left;
    }
</style>