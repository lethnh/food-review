<template>
    <div class="container">
        <div class="row  justify-content-center">
            <div class="shadow col-4 d-flex flex-column">
                <ValidationObserver
                    v-slot="{ passes }"
                    ref="loginForm"
                    tag="form"
                >
                    <form
                        class="login100-form validate-form pt-20"
                        @submit.prevent="loginSubmit()"
                    >
                        <div class="login100-form-title p-b-49 text-center">
                            <!-- Logo -->
                            <router-link to="/toppage">
                                <img
                                    src="/images/icon/logo2.png"
                                    alt="IMG-LOGO"
                                />
                            </router-link>
                            <!-- End logo -->
                        </div>
                        <!-- Email -->
                        <div class="m-b-23">
                            <label class="label-input100">Email</label>
                            <ValidationProvider
                                name="email"
                                rules="required|email"
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
                                            type="email"
                                            v-model="loginData.email"
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
                        <!-- Password -->
                        <div class="mt-20">
                            <label class="label-input100">Mật khẩu</label>
                            <ValidationProvider
                                name="password"
                                rules="required|min:3"
                            >
                                <div slot-scope="{ errors }">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i
                                                    class="fa fa-lock"
                                                    aria-hidden="true"
                                                ></i>
                                            </div>
                                        </div>
                                        <input
                                            type="password"
                                            v-model="loginData.password"
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
                        <!-- End Password -->
                        <!-- Button đăng nhập -->
                        <div class="text-center my-25">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="btn btn-primary">
                                    Đăng nhập
                                </button>
                            </div>
                        </div>
                        <!-- End Button đăng nhập -->
                    </form>
                </ValidationObserver>
                <!-- Footer -->
                <footer class="page-copyright mt-3 text-center">
                    <p>WEBSITE BY ThanhLV</p>
                    <p>© 2019. All RIGHT RESERVED.</p>
                </footer>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</template>
<script>
import AuthService from "../../js/services/Auth";
import Ls from "../../js/services/Ls";
export default {
    data() {
        return {
            loginData: {
                email: "",
                password: "",
                remember: ""
            }
        };
    },
    methods: {
        async loginSubmit() {
            const isValid = await this.$refs.loginForm.validate();
            if (isValid) {
                AuthService.login(this.loginData).then(response => {
                    if (response.status === 200) {
                        Ls.set(
                            "token",
                            JSON.stringify(response.data.access_token)
                        );
                        this.$router.push({
                            name: "adminUser"
                        });
                    }
                });
            }
        }
    }
};
</script>
