<template>
    <div v-show="show_icon" class="icon_filter">{{ modelValue }}</div>
    <div v-show="show" class="filter_wrap_position_fix">
        <div class="filter_bg" :class="{'left':left}">
            <div class="filter_close_btn" @click.stop="close">
                <img src="@/assets/icons/filters/close.svg" alt="">
            </div>
            <div class="title_f">Найти</div>
            <input type="text" :value="modelValue" @input="updateVal">
            <div class="filter_submit_btns">
                <ButtonStd title="Отменить" @click.stop="cancel" width="100px" height="25px" font_size="14px" :border="'1px solid'" bg_color="#16354D" />
                <ButtonStd title="ОК" @click.stop="close" width="100px" height="25px" font_size="14px" />
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'FilterFind',
    data(){
        return{
            show_icon:false,
        }
    },
    props:{
        modelValue:String,
        show: Boolean,
        left:{
            type:Boolean,
            default:false
        }
    },
    emits: ['update:modelValue'],
    methods:{
        updateVal(event){
            this.$emit('update:modelValue', event.target.value)
            this.show_icon = true
        },
        cancel(){
            this.$emit('update:modelValue', '')
            this.close()
            this.show_icon = false
        },
        close(){
            this.$parent.show = false;
        }
    },
}
</script>

<style scoped>
    .icon_filter{
        margin-top: -5px;
        margin-bottom: -8px;
        color:#16354D;
        font-family: 'Play-Bold';
    }
    .filter_wrap_position_fix{
        position: absolute;
    }
    .filter_bg{
        position: relative;
        width: 250px;
        height: 125px;
        top:-155px;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 5px;
        background-color: #16354D;
        box-shadow: 4px 4px 4px #00000030;
    }
    .left{
        left: -200px;
    }
    .filter_close_btn{
        width: 100%;
    }
    .filter_close_btn img{
        float: right;
        margin-top: 10px;
        margin-right: 10px;
        cursor: pointer;
    }
    .title_f{
        margin-top: -22px;
        font-size: 16px;
        color: #fff;
    }
    input{
        width: 210px;
        height: 25px;
        margin: 10px 0px 0px;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 15px;
        font-size: 14px;
        border: 1px solid #6b99c3;
        background-color: #16354d;
        color: #fff;
        outline: none;
    }
    .filter_submit_btns{
        margin-top: 14px;
        width: 100%;
        display: flex;
        justify-content: center;
        column-gap: 10px;
    }
</style>