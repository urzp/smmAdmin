<template>
    <div v-show="show_icon" class="icon_filter">
    <img src="@/assets/icons/filters/filter.svg" alt="">
    </div>
    <div v-show="show" class="filter_wrap_position_fix" >
        <div class="filter_bg" :class="{'left':left}">
            <div class="filter_close_btn" @click.stop="close">
                <img src="@/assets/icons/filters/close.svg" alt="">
            </div>
            <div class="title_f">Сортировать</div>
            <div class="form_filter_status">
                <input type="radio" id="filter_status_success" name="filter_status" value="true" checked @click="updateVal"/>
                <label for="filter_status_success">{{ l_true }}</label>
                <input type="radio" id="filter_status_fall" name="filter_status" value="false" @click="updateVal"/>
                <label for="filter_status_fall">{{ l_false }}</label>
            </div>
            <div class="filter_submit_btns">
                <ButtonStd title="Отменить" @click.stop="cancel" width="100px" height="25px" font_size="14px" :border="'1px solid'" bg_color="#16354D" />
                <ButtonStd title="ОК" @click.stop="close" width="100px" height="25px" font_size="14px" />
            </div>
        </div>
    </div>
</template>

<script>
export default{
    name: 'FilterTrueFalse',
    data(){
        return{
            show_icon:false,
        }
    },
    props:{
        modelValue:String,
        show: Boolean,
        l_true:String,
        l_false:String,
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
    }
    .filter_wrap_position_fix{
        position: absolute;
        width: 0px;
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
    .form_filter_status{
        display: flex;
        align-items: center;
    }
    .form_filter_status input{
        margin: 10px;
        width: 24px;
        height: 24px;
        cursor: pointer;
    }
    .form_filter_status label{
        cursor: pointer;
    }
    .filter_submit_btns{
        margin-top: 14px;
        width: 100%;
        display: flex;
        justify-content: center;
        column-gap: 10px;
    }
</style>