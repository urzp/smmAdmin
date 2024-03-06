<template>
    <div class="header"></div>
    <div class="loginform">
      <div class="title">Вход в панель пшеуправления</div>
      <div class="form">
        <div class="inp-label">Email</div>
        <input type="text" placeholder="user@mail.com" class="email">
        <div class="inp-label">Пароль</div>
        <input type="password" class="email">
      </div>
      <ButtonStd class="btn-right" title="Войти" ></ButtonStd>
    </div>
</template>

<script>
import ButtonStd from '../components/UI/ButtonStd.vue'

export default {
  name: 'LoginPage',
  components:{
    ButtonStd
  }
}
</script>

<style>
  .btn-right{
    float: right;
  }
</style>

<style lang="scss" scoped>
  .header{
    width: 100%;
    height: 100px;
    background-color: #16354D;
  }
  .loginform{
    margin: 220px auto;
    padding: 50px 60px;
    width: 600px;
    height: 400px;
    border-radius: 30px;
    background-color: #fff;
    box-shadow: 4px 4px 12px 4px #0000004d;

    .title{
      font-size: 24px;
      font-family: 'Play-Bold';
    }

    .form{
      margin-top: 25px;
      margin-bottom: 25px;
      .inp-label{
        font-size: 16px;
        text-align: left;
      }

      input{
        margin: 10px 0;
        margin-top: 5px;
        padding-left: 25px;
        padding-right: 25px;
        width: 100%;
        height: 45px;
        background-color: #E4E5EA;
        border: #E4E5EA;
        border-radius: 10px;
        color: #0C151C;
      }

    }
  }
</style>

