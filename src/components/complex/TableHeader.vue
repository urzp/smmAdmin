<template>
    <div class="header-table">
        <slot/>
    </div>
</template>

<script>
export default{
    name: 'TableHeader',
    props:{
        align:{
            type: String,
            default: "space-between",
        }
    }

}
</script>

<style scoped>
.header-table{
    width: 100%;
    height: 50px;
    border-top: 1px solid #D2D2D4;
    border-bottom: 1px solid #D2D2D4;
    display: flex;
    align-items: center;
    justify-content: v-bind(align);
    column-gap: 10px;
    color: #A8A8A8;
}
</style>