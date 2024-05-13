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
                    <div class="title_settings">Настройка сервиса</div>
                    <div class="servis_content_wrap">
                        <div class="form_content">
                            <div class="provider_form">
                                <div class="title_field_form">Провайдер:</div>
                                <div class="provider_field">
                                    <div class="icon_btn_list_provider"><img src="@/assets/icons/btn_list.svg" alt=""></div>
                                    <div class="content_provider">2 https://smmmain.com/api/v2</div>
                                </div>
                                <div class="list_providers_wrap">
                                    <div class="list_providers"></div>
                                </div>
                            </div>
                            <div class="settings_form">
                                <div class="title_field_form">Параметры:</div>
                                <div class="settings_field">
                                    <div class="settings_field_header">
                                        <img class="icon_setting_add" src="@/assets/icons/btn_add.svg" alt="">
                                        <div class="header_colum header_colum_1">Название</div>
                                        <div class="header_colum header_colum_2">Значение</div>
                                    </div>
                                    <div class="setting_field_row">
                                        <div class="colum header_colum_1">id_servis</div>
                                        <div class="colum header_colum_2">4</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_test_buttons">
                            <div class="form_test"></div>
                            <div class="form_buttons">
                                <div class="test_btn">ТЕСТ</div>
                                <div class="save_btn">СОХРАНИТЬ</div>
                            </div>
                        </div>
                    </div>
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

.settings{
    margin-left: 45px;
    width: 60%;
    
    .title_settings{
        text-align: center;
        font-family: 'TildaSansBold';
        font-size: 24px;
        margin-top: 0px;
    }

    .servis_content_wrap{
        display: flex;
    }

    .form_content{
        width: 400px;
        
        .title_field_form{
            font-family: 'TildaSans';
            font-size: 14px;
            text-align: left;
            color: #969696;
            margin-bottom: 5px;
        }

        .provider_form{
            margin-bottom: 20px;
        }

        .provider_field{
            height: 36px;
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: #F4F4F4;
            border-radius: 30px;
        }

        .icon_btn_list_provider{
            margin-left: 10px;
            width: 30px;
            border-right: 1px solid #D2D2D2;
            cursor: pointer;
        }

        .content_provider{
            color: #383838;
        }

        .list_providers_wrap{
            position: relative;
            .list_providers{
                position: absolute;
                height: 300px;
                width: 390px;
                background-color: #eaeaea;
            }
        }

        .settings_field{
            background-color: #F4F4F4;
            border-radius: 20px;
            height: 350px;
            padding: 10px 20px;
            .settings_field_header{
                display: flex;
                align-items: center;
                gap: 10px;
                border-bottom: 1px solid #D2D2D2;
                color: #969696;
                height: 35px;
                .icon_setting_add{
                    cursor: pointer;
                }
                .header_colum_1{
                    width: 50%;
                    border-right: 1px solid #D2D2D2;
                    color: #969696;
                }
                .header_colum_2{
                    width: 50%;
                }
            }

            .setting_field_row{
                display: flex;
                align-items: center;
                gap: 10px;     
                height: 35px;
                .header_colum_1{
                    width: 60%;
                }
                .header_colum_2{
                    width: 50%;
                }
            }
        }

    }

    .form_test_buttons{
        margin-top: 30px;
        margin-left: 30px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        .form_test{
            width: 300px;
            height: 370px;
            background-color: #E2EFDA;
            border-radius: 20px;
        }

        .form_buttons{
            display: flex;
            justify-content: space-around;
            div{
                border-radius: 30px;
                height: 45px;
                width: 135px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .test_btn{
                border: 1px solid #4A55F0;
                color:#4A55F0;
            }
            .save_btn{
                background-color:  #4A55F0;
                color:#ffffff;
            }
        }
    }
}

</style>