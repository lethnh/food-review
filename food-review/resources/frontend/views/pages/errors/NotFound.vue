<template>
  <div class="page-error vertical-align text-center">
    <div class="page-content vertical-align-middle">
      <header>
        <h1 class="animation-slide-top">404</h1>
        <p>Page Not Found !</p>
      </header>
      <p class="error-advise">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
      <router-link to="/" class="btn btn-primary btn-round">GO TO HOME PAGE</router-link>

      <footer class="page-copyright">
        <p>WEBSITE BY ThanhLV</p>
        <p>© 2019. All RIGHT RESERVED.</p>
        <div class="social">
          <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a class="btn btn-icon btn-pure" href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>
      </footer>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style lang="css" scoped>
.page-content {
  padding: 30px 30px;
}
.vertical-align-middle {
  vertical-align: middle;
  display: inline-block;
  max-width: 100%;
  font-size: 1rem;
}
.page-error header h1 {
    font-size: 10em;
    font-weight: 400;
}
.page-error header p {
    margin-bottom: 30px;
    font-size: 30px;
    text-transform: uppercase;
}
.btn-round {
    border-radius: 1000px;
}
.btn-primary {
    color: #fff;
    background-color: #3e8ef7;
    border-color: #3e8ef7;
    box-shadow: none;
}
.page-error .error-advise {
    margin-bottom: 25px;
    color: #A9AFB5;
}
.page-copyright {
    margin-top: 60px;
    font-size: .858rem;
    color: #37474f;
    letter-spacing: 1px;
}
</style>