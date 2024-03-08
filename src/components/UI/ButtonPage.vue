<template>
    <div class="page_button">
        <img v-if="img" :src="`/src/assets/icons/page_panel/${img}.svg`" alt="">
        <div v-else><input type="text" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"></div>
    </div>
</template>

<script>
export default {
    name: 'ButtonPage',
    props:{
        img:String,
        modelValue:String,
    },
    emits: ['update:modelValue'],
}
</script>

<style lang="scss"  scoped>

.page_button{
    width: 70px;
    height: 34px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 30px;
    border: 1px solid #A8A8A8;
    cursor: pointer;
    color:#A8A8A8;
    transition: 0.3s;

    input{
        width: 70px;
        text-align: center;
        border: none;
        outline:none;
        background-color: transparent;
        color: #A8A8A8;
    }
}

.page_button:hover{
    background-color: #214260;
    border: none;
    input{
        color: #fff;
    }
}

</style>