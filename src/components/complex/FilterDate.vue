<template>
    <div v-show="show" class="filter_wrap_position_fix">
    <div class="filter_bg">
        <div class="filter_close_btn" @click.stop="close">
                <img src="@/assets/icons/filters/close.svg" alt="">
        </div>
        <div class="title_f">Выбрать даты</div>
        <div class="until_group">
            <div class="label">до:</div>
            <input type="date" :value="modelValue.until" @input="updateValUntil">
        </div>
        <div class="from_group">
            <div class="label">от:</div>
            <input type="date" :value="modelValue.from" @input="updateValFrom">
        </div>
        <div class="filter_submit_btns">
                <ButtonStd title="ОК" @click.stop="close" width="100px" height="25px" font_size="14px" />
        </div>
    </div>
    </div>
</template>

<script>
export default{
    name: 'FilterDate',
    data(){
        return{
            show_icon:false,
        }
    },
    props:{
        modelValue: Object,
        show: Boolean,
    },
    emits: ['update:modelValue'],
    methods:{
        updateValUntil(event){
            let until = event.target.value;
            let result = {
                until,
                from: this.modelValue.from
            }
            this.$emit('update:modelValue', result)
        },
        updateValFrom(event){
            let from = event.target.value;
            let result = {
                from,
                until: this.modelValue.until,
            }
            this.$emit('update:modelValue', result)
        },
        cancel(){
            this.$emit('update:modelValue', {})
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
    .filter_wrap_position_fix{
        position: absolute;
    }
    .filter_bg{
        position: relative;
        width: 280px;
        height: 160px;
        top:-200px;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 5px;
        background-color: #16354D;
        box-shadow: 4px 4px 4px #00000030;
    }
    .filter_close_btn{
        width: 100%;
        margin-bottom: 5px;
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
    .until_group, .from_group{
        width: 90%;
        display: flex;
        align-items: flex-end;
        justify-content: space-evenly;
    }
    .label{
        color:#fff;
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
        color-scheme: dark;
    }
    .filter_submit_btns{
        margin-top: 14px;
        width: 100%;
        display: flex;
        justify-content: center;
        column-gap: 10px;
    }
</style>