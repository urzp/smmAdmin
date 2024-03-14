<template>
    <div class="page_button">
        <div v-if="img" class="img">
            <slot/>
        </div>
        <div v-else><input type="number" :value="modelValue" @change="$emit('update:modelValue', Number($event.target.value))"></div>
    </div>
</template>

<script>
export default {
    name: 'ButtonPage',
    props:{
        img:String,
        modelValue:Number,
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

input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0; 
}

input[type='number'] {
    -moz-appearance: textfield;
}

.img {
    display: flex;
    -webkit-touch-callout: none; 
    -webkit-user-select: none; 
     -khtml-user-select: none; 
       -moz-user-select: none; 
        -ms-user-select: none; 
            user-select: none; 
}
</style>