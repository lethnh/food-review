<template>
    <div class="limiter">
        <div class="container-login100 flex-column">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54 shadow">
                <ValidationObserver
                    v-slot="{ passes }"
                    ref="resetForm"
                    tag="form"
                >
                    <form
                        class="login100-form validate-form"
                        @submit.prevent="resetPassword()"
                    >
                        <span class="login100-form-title p-b-49">
                            <!-- Logo -->
                            <router-link to="/">
                                <img
                                    src="/images/icon/logo2.png"
                                    alt="IMG-LOGO"
                                />
                            </router-link>
                            <!-- End logo -->
                        </span>
                        <!-- Email -->
                        <div class="m-b-23">
                            <label class="label-input100">Mật khẩu</label>
                            <ValidationProvider
                                name="password"
                                rules="required|min:3|max:10"
                                vid="confirmation"
                            >
                                <div slot-scope="{ errors }">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i
                                                    class="fa fa-envelope"
                                                    aria-hidden="true"
                                                ></i>
                                            </div>
                                        </div>
                                        <input
                                            type="password"
                                            v-model="data.password"
                                            class="form-control"
                                            :class="{ 'is-invalid': errors[0] }"
                                        />
                                    </div>
                                    <small
                                        :class="{ 'is-danger': errors[0] }"
                                        >{{ errors[0] }}</small
                                    >
                                </div>
                            </ValidationProvider>
                        </div>
                        <div class="m-b-23">
                            <label class="label-input100"
                                >Nhập lại mật khẩu</label
                            >
                            <ValidationProvider
                                name="password_confirmation"
                                rules="required|min:3|max:10|confirmed:confirmation"
                            >
                                <div slot-scope="{ errors }">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i
                                                    class="fa fa-envelope"
                                                    aria-hidden="true"
                                                ></i>
                                            </div>
                                        </div>
                                        <input
                                            type="password"
                                            v-model="data.password_confirmation"
                                            class="form-control"
                                            :class="{ 'is-invalid': errors[0] }"
                                        />
                                    </div>
                                    <small
                                        :class="{ 'is-danger': errors[0] }"
                                        >{{ errors[0] }}</small
                                    >
                                </div>
                            </ValidationProvider>
                        </div>
                        <!-- End Email -->
                        <!-- Button đăng nhập -->
                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                    Đặt lại mật khẩu
                                </button>
                            </div>
                        </div>
                        <!-- End Button đăng nhập -->
                    </form>
                </ValidationObserver>
            </div>
            <!-- Footer -->
            <div class="site-footer mt-4">
                <div class="site-footer-legal">
                    © 2019
                    <a href="#">Food Review</a>
                    Crafted with
                    <i class="red-600 wb wb-heart"></i> by
                    <a href="#">ThanhLV</a>
                </div>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</template>
<script>
import AuthService from "../../../js/services/Auth";
export default {
    data() {
        return {
            data: {
                token: this.$route.query.token,
                password: "",
                password_confirmation: ""
            }
        };
    },
    methods: {
        async resetPassword() {
            const isValid = await this.$refs.resetForm.validate();
            if (isValid) {
                AuthService.resetPassword(this.data).then(response => {
                    this.$router.push({ path: "login" }).catch(err => {});
                });
            }
        }
    }
};
</script>
<style lang="css">
.travel-map {
    height: 400px;
}
.google-map {
    min-height: 100%;
}
</style>
